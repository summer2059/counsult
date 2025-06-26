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
            'site_title', 'jp_site_title',
            'site_description', 'jp_site_description',
            'site_address', 'jp_site_address',
            'map_link', 'jp_map_link',
            'site_logo', 'jp_site_logo',
            'site_favicon', 'jp_site_favicon',
            'footer_logo', 'jp_footer_logo',
            'office_number', 'jp_office_number',
            'primary_phone_number', 'jp_primary_phone_number',
            'email_address', 'jp_email_address',
            'facebook_link', 'jp_facebook_link',
            'instagram_link', 'jp_instagram_link',
            'copyright', 'jp_copyright',
            'terms', 'jp_terms',
            'privacy', 'jp_privacy',
            'keywords', 'jp_keywords',
            'description', 'jp_description',
            'footer_description', 'jp_footer_description',
            'copyright_notice', 'jp_copyright_notice',
            'twitter_link', 'jp_twitter_link',
            'android_app_link', 'jp_android_app_link',
            'ios_app_link', 'jp_ios_app_link',
            'site_detail', 'jp_site_detail',
            'video_title', 'jp_video_title',
            'video_description',    'jp_video_description',
            'site_video', 'jp_site_video',
            'pdf', 'jp_pdf',
            'linkedin_link', 'jp_linkedin_link',
        );

        foreach ( $inputs as $inputKey => $inputValue ) {
            if ( $inputKey == 'site_logo' || $inputKey == 'jp_site_logo' || $inputKey == 'site_favicon' || $inputKey == 'jp_site_favicon' || $inputKey == 'footer_logo' || $inputKey == 'jp_footer_logo' || $inputKey == 'site_video' || $inputKey == 'jp_site_video' || $inputKey == 'pdf' || $inputKey == 'jp_pdf') {

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
