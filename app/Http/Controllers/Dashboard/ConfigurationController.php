<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function getConfiguration(){
        return view('dashboard.settings.index');
   }

   public function postConfiguration( Request $request ) {
        $inputs = $request->only(
            'site_title',
            'site_description',
            'site_address',
            'map_link',
            'site_logo',
            'site_favicon',
            'footer_logo',
            'office_number',
            'primary_phone_number',
            'email_address',
            'facebook_link',
            'instagram_link',
            'copyright',
            'terms',
            'privacy',
            'keywords',
            'description',
            'footer_description',
            'copyright_notice',
            'twitter_link',
            'android_app_link',
            'ios_app_link',
            'site_detail',
            'video_title',
            'video_description',
            'site_video',
            'pdf'
        );

        foreach ( $inputs as $inputKey => $inputValue ) {
            if ( $inputKey == 'site_logo' || $inputKey == 'site_favicon' || $inputKey == 'footer_logo' || $inputKey == 'site_video' || $inputKey == 'pdf') {

                $file = $inputValue;
                // Delete old file
                $this->deleteFile( $inputKey );
                // Upload file & get store file name
                $inputValue   = $this->uploadFile( $inputValue );
            }



            Configuration::updateOrCreate( [ 'configuration_key' => $inputKey ], [ 'configuration_value' => $inputValue ] );
        }

        toast('Your Input as been Updated!','success');
        return redirect()->back();
    }



    protected function uploadFile( $file ) {
        $image_new_name = time().$file->getClientOriginalName();
        $file->move('uploads/configurations', $image_new_name);
        return 'uploads/configurations/'. $image_new_name;
    }

    protected function deleteFile( $inputKey ) {
        $configuration = Configuration::where( 'configuration_key', '=', $inputKey )->first();
        // Check if configuration exists
        if ( null !== $configuration && $configuration->exists() ) {
            if(file_exists('uploads/configurations/'.basename($configuration->configuration_value))){
                unlink('uploads/configurations/'.basename($configuration->configuration_value));
            }
        }
    }
}
