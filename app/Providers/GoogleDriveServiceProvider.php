<?php

namespace App\Providers;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\ServiceProvider;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('google-drive', function ($app) {
            $client = new Client();
            $client->setAuthConfig([
                "type" => "service_account",
                "project_id" => "website-qurban",
                "private_key_id" => "874dff1906b54fe98776372f83593dad39e2153c",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC7ddQgtbl49bwG\nTWW8ROVc5wc2m2J84+Ae0GEL+fP/7AASxUIpSJ0ACkDYdcqETuOQtML8Wz96WfAs\n1z3bt5xGXqtVXgBhMdebFbr3b/z2RAOTR71gdnkTwu3X6YoBAFc/0kVWH0YKUU97\nwmqBARtFOBeWsQBFjoUyq8QF9GMjfQIv4EwFUebbc33tgoi6gLhCdeNgZ9+8+yyz\nwmfXza6eAjyh08DPf5RmLSIFZxxTlnRwlIK/CwjFqCCnqRRo+R46Oncj63ixUX5v\naUpBEA5dBqAyLI8jfdmxs5TgkzTdlGz5N5dlt8YMn5AVUQEV8/F4N5aIW3Ad0mWI\ndf7JlFztAgMBAAECggEAA2nyaoQUtBy5h13ad/LDQI1ehsKOqRqXRshhtA+hv2vj\nVnQsL8dIQKtvIeIHRaCQKV75XBInVkmUA6UJ1doCqQ9pTF0xYZPASu064e2yrCNx\n8zkvvDV8H/2BSljQ8BK7BAkGxTo9ksuHSIgyW1YTUo/ichaYHCwrxc/1+mvIcGl6\n6GPXRv7uMKVkCiTBcLV4U3OGB74VpHfc4uEyobgw9kdAzSTIjhxDVC7gsrf+NRp3\n8sYOt+q4NRqMcACjRyCJ/ECcFMZmMlXugOg8NBS2irYqsMDL9yIyxzz9gQlg3++Q\nALRiMBzndbmQa+DDlmG2nKwTXW7lsaSBlq4NNnZbgQKBgQDiu2lQdsSIwvPLZaJT\nPhqa0XVPXEx4uBD2a8zj0aTt1esDZa4PQaFVZtdrqcBNHzWoidFWgxrduWYg/1Xl\nsNYDVLIs5JnxHU7JViEXSmygcXZyYeNZElVT2rO3lGAnXZufsJW0BhrlpcpZMrn7\nqYJ/D/C/oh/4Ig+ssNZCk+PRwQKBgQDTqKQZFb8ypN5bcDfP7hm/S390v/ruWrY6\naWb7MaHnZbLSnwLnF+9PvVVPDtJCsIh3jYf5TAnhg5HIMxZQH6ubbIll8SOiO4D4\n6e9EYIJ6YIaMNWxXb5u5wuL2frz9/SSt6P3t/eP3UzOPl16dyorCOV6If9yiceeQ\nzIwhxSv+LQKBgBzIrhYI/epe1ZR80p6+w6Hj9YCdtxecRosCJIDHnKiU/8Dup6pI\nKrMs2yxP4Jnp3GYJGQpimoaLguutfroqOQEzP2tzmheCIP5ucMUELcYwoVjkFHi6\nWxrKKQalT4+v0pHzWQ4BuGhvI8EvL21Dl82JuIabjnNx34uM56aMH+ABAoGBAI0T\nYJ0fs5rr7RGBUJIVH7AzgDavJ2/ron54dp2DTWjQjkp4lhS2DVpW1h+lv1uYEr2s\n5i6yEfvwGCEafArXsSgdRc9e1ONzSdmfA03ODenHoKafjSESUPeWAHVPsGSSb/pC\ny83vZh0ZpcpVmEkQEUC3wFy27LaRuUj4LYbsxw/ZAoGBAK1pKf6I/gSpRZCZHCzA\nuwpcEbretDmn23AbBlR8NCyBpA2o8r0MCMiyswb9vFHFogrfVm3/dp7wOZXFnOiB\nWeeIhErtnDM55e7ieo9Cha8XIlYlekZBNI9A9S4DGQkdnOCZb3yXacQTlWIOwbsP\nVaR05Wn4BCNqPhF1hgGZVyP8\n-----END PRIVATE KEY-----\n",
                "client_email" => "website-qurban-25@website-qurban.iam.gserviceaccount.com",
                "client_id" => "104674723190057937211",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/website-qurban-25%40website-qurban.iam.gserviceaccount.com"
            ]);
            $client->setScopes([Drive::DRIVE_FILE]);
            return new Drive($client);
        });
    }
}
