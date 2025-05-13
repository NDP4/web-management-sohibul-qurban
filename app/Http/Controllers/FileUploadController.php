<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class FileUploadController extends Controller
{
    protected $driveService;
    protected $folderId;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(config('google.service_account_credentials'));
        $client->addScope(Drive::DRIVE);
        $this->driveService = new Drive($client);
        $this->folderId = config('google.folder_id');
    }

    public function store(Request $request)
    {
        try {
            Log::info('Upload request received', $request->all());

            $file = null;
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
            } elseif ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
            }

            if (!$file) {
                Log::error('No file in request');
                return response()->json(['error' => 'No file uploaded'], 400);
            }

            $sohibulName = $request->input('sohibul_name');
            $pengeluaranName = $request->input('pengeluaran_name');

            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return response()->json(['error' => 'Invalid file type. Only JPG, PNG and PDF allowed'], 400);
            }

            // Validate file size (max 3MB)
            if ($file->getSize() > 3 * 1024 * 1024) {
                return response()->json(['error' => 'File too large. Maximum size is 3MB'], 400);
            }

            // Generate filename
            $extension = $file->getClientOriginalExtension();
            if ($sohibulName) {
                $filename = str_replace(' ', '_', strtolower($sohibulName)) . '_bukti_transfer_' . time() . '.' . $extension;
            } else {
                $filename = str_replace(' ', '_', strtolower($pengeluaranName)) . '_bukti_pengeluaran_' . time() . '.' . $extension;
            }

            // Upload to Google Drive
            try {
                $fileMetadata = new DriveFile([
                    'name' => $filename,
                    'parents' => [$this->folderId]
                ]);

                $file = $this->driveService->files->create($fileMetadata, [
                    'data' => file_get_contents($file->getRealPath()),
                    'mimeType' => $file->getMimeType(),
                    'uploadType' => 'multipart',
                    'fields' => 'id'
                ]);

                return response($file->id, 200);
            } catch (\Exception $e) {
                Log::error('Google Drive upload failed: ' . $e->getMessage());
                return response()->json(['error' => 'Failed to upload file to Google Drive'], 500);
            }
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $fileId = $request->getContent();
            if ($fileId) {
                $this->driveService->files->delete($fileId);
                return response()->json(['success' => true]);
            }
            return response()->json(['error' => 'File ID not provided'], 400);
        } catch (\Exception $e) {
            Log::error('File deletion error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
