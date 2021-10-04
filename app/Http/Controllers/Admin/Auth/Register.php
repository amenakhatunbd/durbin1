<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Model\Common\Role;
use App\Model\Common\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\SM\SM;
use App\Admin;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Artisan;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Register extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller for Admin
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new admin users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    use RegistersUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('guest');
    }

    function getDBEmpty()
    {
        try {
            //database backup
            //Disable in demo
            if (config('app.env') == 'demo') {
                $output = ['success' => 0,
                    'msg' => 'Feature disabled in demo!!'
                ];
                return back()->with('status', $output);
            }
            // start the backup process
//            Artisan::call('backup:run');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
//            database backup End
            $this->setEnv("ALLOW_REGISTRATION", "true");
            ini_set('max_execution_time', 0);
            ini_set('memory_limit', '512M');
            //all table truncate
            DB::statement("SET foreign_key_checks=0");
            $databaseName = DB::getDatabaseName();
            $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
            foreach ($tables as $table) {
                $name = $table->TABLE_NAME;
                //if you don't want to truncate migrations
                if ($name == 'migrations') {
                    continue;
                }
                DB::table($name)->truncate();
            }
            DB::statement("SET foreign_key_checks=1");
            //end all table truncate
//            DB::statement('SET default_storage_engine=INNODB;');
//            Artisan::call('migrate:fresh', ["--force" => true]);
            Artisan::call('db:seed');
            Artisan::call('storage:link');
            $output = __('add_new.database_backup_full_database_empty_successfully');

            return redirect()->route('admin.getRegister')->with('s_message', $output);
        } catch (Exception $e) {
            return redirect()->back()
                ->with('w_message', 'Something went wrong, please try again!!');
        }
    }

    function migrateRefresh()
    {
        try {
            //database backup
            //Disable in demo
            if (config('app.env') == 'demo') {
                $output = ['success' => 0,
                    'msg' => 'Feature disabled in demo!!'
                ];
                return back()->with('status', $output);
            }
            // start the backup process
//            Artisan::call('backup:run');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
//            database backup End
            $this->setEnv("ALLOW_REGISTRATION", "true");
            ini_set('max_execution_time', 0);
            ini_set('memory_limit', '512M');
            //migrate:fresh start
            DB::statement('SET default_storage_engine=INNODB;');
            Artisan::call('migrate:fresh', ["--force" => true]);
            //migrate:fresh end
            Artisan::call('db:seed');
            Artisan::call('storage:link');
//            $output = ['success' => 1,
//                'msg' => __('add_new.migrate_refresh_successfully')
//            ];
            $output = __('add_new.migrate_refresh_successfully');
            return redirect()->route('admin.getRegister')->with('status', $output);
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again!!');
        }
    }

    private function setEnv($key, $value)
    {

        $path = base_path('.env');

        if (is_bool(env($key))) {
            $old = env($key) ? 'true' : 'false';
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=" . $old, "$key=" . $value, file_get_contents($path)
            ));
        }
    }

    function index()
    {
        if (!config('app.allow_registration', false)) {
            return redirect('/');
        }

        if (Auth('admins')->check()) {
            return redirect(SM::smAdminSlug());
        } else {
            return view('nptl-admin.Auth.registration');
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//      $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect(config('constant.smAdminSlug') . '/login')
            ->with('s_message', 'Account successfully created! <br>Please login!');
//            ->with('s_message', 'Account successfully created! <br>Please wait for admin Approval!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:6|max:100|unique:admins',
            'email' => 'required|email|max:100|unique:admins',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'terms' => 'required'
        ]);
    }

    protected function business_setting($data)
    {

        $roles = Role::create([
            'name' => 'Admin',
            'permission' => '',
            'created_by' => 1,
            'status' => 1
        ]);
        $unit = Unit::create([
            'title' => 'Pc(s)',
            'slug' => str_slug('Pc(s)'),
            'actual_name' => 'Pieces',
            'created_by' => 1,
            'status' => 1
        ]);

        $this->update_setting('site_name', $data['business_name']);
        $this->update_setting('tag_line', $data['business_name']);
        $this->update_setting('email', $data['email']);
        $this->update_setting('currency', 19);
//        $this->update_setting('year', SM::start_year());

        return array('role_id' => $roles->id);
    }

    private
    function update_setting($option_name, $option_value)
    {
        SM::update_setting($option_name, $option_value);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $business_setting = $this->business_setting($data);

        $admin = Admin::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'role_id' => $business_setting['role_id'],
            'status' => 1,
        ]);

        //env change ALLOW_REGISTRATION false
        $this->setEnv("ALLOW_REGISTRATION", "false");
        $admin_id = $admin->id;
        SM::update_user_meta($admin_id, 'gender', $data['gender']);
        return $admin;
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admins');
    }

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

}