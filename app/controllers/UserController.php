    <?php
    defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

    /**
     * Controller: User
     * 
     * Automatically generated via CLI.
     */
    class UserController extends Controller {
        public function __construct()
        {
            parent::__construct();
            $this->call->model('User_Model');
            $this->call->model('Profile_Model');
            $this->call->library('form_validation');
            // $this->call->helper('message'); nalagay kona sa autoload
        }


        public function read(){
            $page = 1;
            if(isset($_GET['page']) && ! empty($_GET['page'])) {
                $page = $this->io->get('page');
            }

            $q = '';
            if(isset($_GET['q']) && ! empty($_GET['q'])) {
                $q = trim($this->io->get('q'));
            }

            $records_per_page = 3;

            // Get paginated data from model
            // $data['getAll'] = $this->User_Model->getAll(); 
            $all = $this->User_Model->getAll($q, $records_per_page, $page);

            $data['getAll'] = $all['records'];
            $total_rows = $all['total_rows'];

            // Setup pagination appearance & behavior
            $this->pagination->set_options([
                'first_link'     => '⏮ First',
                'last_link'      => 'Last ⏭',
                'next_link'      => 'Next →',
                'prev_link'      => '← Prev',
                'page_delimiter' => '&page='
            ]);

            $this->pagination->set_theme('bootstrap'); 
            $this->pagination->initialize($total_rows, $records_per_page, $page, 'admin?q='.$q );
            // site_url('admin').'?q='.$q ito yung error ko kanina, idk bakit 
            $data['page'] = $this->pagination->paginate();
            $this->call->view('admin/admin_Panel', $data);
        }


        public function registerForm(){
            $this->call->view('users/register');
        }

        public function createUser()
        {

            $this->form_validation
                ->name('first_name')
                    ->required()
                    ->max_length(200)
                ->name('last_name')
                    ->required()
                    ->max_length(200)
                ->name('username')
                    ->required()
                    ->max_length(20)
                ->name('password')
                    ->required()
                    ->min_length(8)
                    ->max_length(100)
                ->name('email')
                    ->required()
                    ->valid_email();

            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->get_errors();
                setErrors($errors);
                // $_SESSION['old'] = $_POST;           //save old imput
        redirect('/register');

            } else {
               
                
                //ORM
                //so instead na tawagin ko pa yung method ng pag insert sa model pwede na dito - less code
                $email = $_POST['email'];
                $exist = $this->User_Model->getByEmail($email);

                if($exist){
                
                    setMessage('danger', 'Email already exist!');
redirect('/register');
                }else{
                $user_id = $this->User_Model->insert([
                'first_name' => $_POST['first_name'], // this-io->post
                'last_name' => $_POST['last_name'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)

                ]);

                // $this->Profile_Model->insert([
                //     'user_id' => $user_id
                // ]);

                setMessage('success', 'User registered successfully!');
                $this->call->view('users/register');

                }

                
            }

        }



        public function updateUser($id){
            $this->User_Model->update($id, [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
            ]);
            setMessage('success', 'User updated successfully!');
            redirect('/admin');

        }

        public function deleteUser($id){
        
            $this->User_Model->delete($id);
            setMessage('danger', 'User delete successfully!');
            redirect('/admin');      
                
            

        }

        public function login()
        {
            $this->call->view('users/login');
        
        }
        
        public function updateProfile(){
            $user_id = $this->session->userdata('user_id'); 
            $profile = $this->Profile_Model->getForeignId($user_id);
            $profile_id = $profile['id']; 

             $this->form_validation
                ->name('username')
                    ->required();

            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->get_errors();
                setErrors($errors);
                redirect('/');
            } else {
           $this->Profile_Model->update(
                  $profile_id,
                    [
                        'phone' => $_POST['phone'] ?? '',
                        'address' => $_POST['address'] ?? '',
                        'birthday' => $_POST['birthday'] ?? '',
                        'gender' => $_POST['gender'] ?? '',
                        'course' => $_POST['course'] ?? '',
                        'emergency_contact' => $_POST['emergency_contact'] ?? '',
                        'about' => $_POST['about'] ?? '',
                        'facebook' => $_POST['facebook'] ?? '',
                        'linkedin' => $_POST['linkedin'] ?? '',
                        'github' => $_POST['github'] ?? '',
                    ]
                );
        
             setMessage('success', 'Profile updated successfully!');

         
            redirect('users/home');

        }
        }

        public function home(){
            if(!$this->session->has_userdata('logged_in')){
                redirect('/');
            }

            
            $user_id = $this->session->userdata('user_id');
            $data['profile'] = $this->Profile_Model->findByUserId($user_id);
            $data['user'] = $this->User_Model->find($user_id);

            $this->call->view('users/home', $data);

        }

        public function authenticate()
        {
            $this->form_validation
                ->name('username')
                    ->required()
                ->name('password')
                    ->required();

            if ($this->form_validation->run() == FALSE) {
                $errors = $this->form_validation->get_errors();
                setErrors($errors);
                redirect('/');
            } else {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $user = $this->User_Model->getByUsername($username);
                //ginet ko yung username then pwede ko na rin ma get yung o ibang  ano sa table like username[password]
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                      $this->session->set_userdata([
                                'first_name' => $user['first_name'],
                                'user_id' => $user['id'],
                                'username' => $user['username'],
                                'logged_in' => TRUE
                            ]);

                            setMessage('success', 'Welcome back, ' . $user['first_name']);
                            redirect('/users/home');
                        } else {
                            setMessage('danger', 'Invalid password.');
                            redirect('/');
                        }
                    } else {
                        setMessage('danger', 'User not found.');
                        redirect('/');
                    }
                } 
            }   

            public function logout()
                {
                    $this->session->unset_userdata(['user_id', "username", 'email', 'logged_in']);
                    redirect('/');
                }


    }
