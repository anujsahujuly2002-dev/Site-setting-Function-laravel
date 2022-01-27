public function UpdateSetting(Request $request)
    {
        if($request->isMethod('POST'))
        {
             // dd($request->all());
             $settingIndecator=$request->setting_name;
             $SettingVal=$request->setting_val;
             // echo $settingIndecator."<br>";
             // echo $SettingVal;
             // dd($settingIndecator);
             // die;
             if($settingIndecator=='site_logo')
             {
                // dd($request->all());
                $settingVal=$request->old_site_logo;
                if($request->hasFile('setting_val'))
                {
                    $imageName=time().'.'.$request->setting_val->getClientOriginalExtension();
                    // dd($imageName);
                    $upload=$request->file('setting_val')->move('uploads/logo',$imageName);
                    // dd($upload);
                    $SettingVal=$imageName;
                }
             }
             // dd($SettingVal);
             if(!empty($settingIndecator))
             {
                $updatearr =  array(
                    'setting_val'=>$SettingVal
                );
                // $insert=new Site_settings;
                // $insert->setting_name=$settingIndecator;
                // $insert->setting_val=$SettingVal;
                // $update=$insert->save();
                $update=Site_settings::where('setting_name','=',$settingIndecator)->update($updatearr);
                if($update)
                {
                    return redirect()->back()->with('alert-success','Successfully Done!');
                }
                else
                {
                    return redirect()->back()->with('alert-danger','Not added please try');
                 }
             }
        }
    }  
