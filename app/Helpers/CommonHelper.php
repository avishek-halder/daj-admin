<?php

namespace App\Helpers;

use Cache;
use DB;
use Image;
use Request;
use Route;
use Schema;
use Session;
use Storage;
use Validator;
use App\Settings;
use App\Categorie;

class CommonHelper
{
    /**
     *  Comma-delimited data output from the child table
     */
     public static function first($table, $id)
    {
        $table = self::parseSqlTable($table)['table'];
        if (is_array($id)) {
            $first = DB::table($table);
            foreach ($id as $k => $v) {
                $first->where($k, $v);
            }

            return $first->first();
        } else {
            $pk = self::pk($table);

            return DB::table($table)->where($pk, $id)->first();
        }
    }
    public static function getSetting($name)
    {
        // if (Cache::has('setting_'.$name)) {
        //     return Cache::get('setting_'.$name);
        // }

        $query = DB::table('admin_settings')->select($name)->first();
        if(!empty($query))
        {
            Cache::forever('setting_'.$name, $query->$name);

            return $query->$name;
        }
       
    }
    public static function sendEmail($config = [])
    {

        $to = $config['to'];
        $data = $config['data'];
        $template = $config['template'];

        $template = AdminHelper::first('cms_email_templates', ['slug' => $template]);
        $html = $template->content;
        $subject = $template->subject;
        foreach ($data as $key => $val) {
            $html = str_replace('['.$key.']', $val, $html);
            $template->subject = str_replace('['.$key.']', $val, $template->subject);
            $subject = str_replace('['.$key.']', $val, $subject);
        }
        $attachments = (!empty($config['attachments'])) ?$config['attachments']: [];

        $setting_dtls = Settings::find(1);
        $logo =  $setting_dtls->logo;
        \Mail::send("emails.email_template", ['content' => $html,'logo'=>$logo], function ($message) use ($to, $subject, $template, $attachments) {
            $message->priority(1);
            $message->to($to);

            if ($template->from_email) {
                $from_name = ($template->from_name) ?: AdminHelper::getSetting('appname');
                $message->from($template->from_email, $from_name);
            }

            if ($template->cc_email) {
                $message->cc($template->cc_email);
            }

            if (count($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }

            $message->subject($subject);
        });
    }


   public static function getCategoryList()
   {
        return Categorie::where('status', 1)->whereNull('parent_id')->orderBy('name')->limit(9)->get();
   }
}
