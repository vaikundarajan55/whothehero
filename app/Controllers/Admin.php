<?php

namespace App\Controllers;
use App\Models\AppModel;

class Admin extends BaseController
{
    protected $AppModel;

    public function __construct()
    {
        $this->AppModel = new AppModel();
    }
    public function index(): string
    {
        return view('admin/signin');
    }
    public function login()
    {
        
        $session = session();

        $user_email = $this->request->getPost('user_email');
        $password = $this->request->getPost('password');


        if (empty($user_email) || empty($password)) {
            return redirect()->back()->with('msg', 'All fields are required');
        }

        $table_name = "admin";
        $where_condition = ['user_email' => $user_email,'password' => $password];

        $data = $this->AppModel->fetchData($table_name, $where_condition);
        

        if ($data) {
            // ✅ Secure password check
            
                $ses_data = [
                    'admin_id'     => $data->admin_id,
                    'user_name'    => $data->user_name,
                    'user_email'   => $data->user_email,
                    'logged_in'    => true
                ];
                //print_r($ses_data); exit;

                $session->set($ses_data);
                $session->setFlashdata('msg', 'Login Successfully');
                return redirect()->to(site_url('/admin/dashboard'));
        } else {
            $session->setFlashdata('msg', 'Username not found');
            return redirect()->to(site_url('/admin'));
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('/'));
    } 
    function dashboard()
    {
        $cat_table       = "admin_category";
        $cat_condition   = array('cat_status' => 'Active');
        $arr['Catcount'] = $this->AppModel->fetchCountData($cat_table, $cat_condition);
        
        $scat_table       = "admin_subcategory";
        $scat_condition   = array('web_status' => 'Active');
        $arr['SCatcount'] = $this->AppModel->fetchCountData($scat_table, $scat_condition);

        return view('admin/pages/dashboard',$arr);
    }
    function categorylist()
    {
        $data['headerName'] = "CategoryList";
        $table_name = "admin_category";
        $where_condition = array('cat_status' => 'Active');
        $data['categoryList'] = $this->AppModel->fetchAllData($table_name, $where_condition);
        return view('admin/pages/categorylist',$data);
    }
    function addcategory()
    {
        return view('admin/add/addcategory');
    }
    function categoryaddNew()
    {
        $cat_name = $this->request->getPost('cat_name');
        // Correct way to get file
        $img = $this->request->getFile('cat_image');

        $validationRule = [
            'cat_image' => [
                'label' => 'Image File',
                'rules' => 'uploaded[cat_image]'
                    . '|is_image[cat_image]'
                    . '|mime_in[cat_image,image/jpg,image/jpeg,image/png,image/webp]'
                    . '|max_size[cat_image,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            return view('upload_form', [
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $imageName = '';

        if ($img->isValid() && !$img->hasMoved()) {
            $imageName = $img->getRandomName();
            $img->move('uploads/', $imageName);
        }

        // Example DB insert (optional)
        $data = [
            'cat_name'  => $cat_name,
            'cat_image' => $imageName,
            'created_at' =>date('Y-m-d H:s:i'),
            'updated_at' =>date('Y-m-d H:s:i'), 
        ];

        // insert into DB here
         $this->AppModel->insertData($data);

        return redirect()->to('/categorylist')->with('success', 'Category added successfully!');
    }
    function editcategory($cid = null)
    {
        $data['headerName'] = "EditCategory";
        $table_name = "admin_category";
        $where_condition = array('cat_status' => 'Active','cid' => $cid);
        $data['edicat'] = $this->AppModel->fetchData($table_name, $where_condition);
        return view('admin/edit/editcategory',$data);
    }
    function cateditNew()
    {
        $cat_name = $this->request->getPost('cat_name');
        $cid   = $this->request->getPost('cid'); // ✅ FIXED
        $img      = $this->request->getFile('cat_image');
        $old_img  = $this->request->getPost('old_image');

        $imageName = '';

        // ✅ Image validation only if file uploaded
        if ($img && $img->isValid() && !$img->hasMoved()) {

            $validationRule = [
                'cat_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[cat_image]'
                        . '|mime_in[cat_image,image/jpg,image/jpeg,image/png,image/webp]'
                        . '|max_size[cat_image,2048]',
                ],
            ];

            if (!$this->validate($validationRule)) {
                return view('upload_form', [
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $imageName = $img->getRandomName();
            $img->move('uploads/', $imageName);
        }

        // ✅ Prepare data
        $data = [
            'cat_name'   => $cat_name,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        

        // ✅ Only update image if uploaded
        if (!empty($imageName)) {
            $data['cat_image'] = $imageName;
        } else {
            $data['cat_image'] = $old_img;
        }
        
        // ✅ Where condition
        $where_condition = array('cid' => $cid);
        $table_name = "admin_category";

        // ✅ Update query (IMPORTANT)
        $this->AppModel->UpdateData($data,$table_name,$where_condition);

        // ✅ Redirect
        return redirect()->to('/categorylist')
                     ->with('success', 'Category updated successfully!');
    }
    function delcategory($cid = null)
    {
        //$cid   = $this->request->getPost('cid'); // ✅ FIXED
        
        // ✅ Where condition
        $where_condition = array('cid' => $cid);
        $data = array('cat_status' => 'InActive');
        $table_name = "admin_category";

        // ✅ Update query (IMPORTANT)
        $this->AppModel->UpdateData($data,$table_name,$where_condition);

        // ✅ Redirect
        return redirect()->to('/categorylist')->with('success', 'Category Deleted successfully!');
    }
    function subcategorylist()
    {
        $data['headerName']   = "SubCategoryList";
        $data['subcategoryList'] = $this->AppModel->fetchSubcategoryData();
        return view('admin/pages/subcategorylist',$data);
    } 
    function addsubcategory()
    {
        $data['headerName']   = "Add SubCategory";
        $table_name = "admin_category";
        $where_condition = array('cat_status' => 'Active');
        $data['categoryList'] = $this->AppModel->fetchAllData($table_name, $where_condition);
        return view('admin/add/addsubcategory',$data);
    }
    function subcategoryaddNew()
    {
        $web_title = $this->request->getPost('web_title');
        $cid = $this->request->getPost('cid');
        // Correct way to get file
        $img = $this->request->getFile('web_image');

        $validationRule = [
            'web_image' => [
                'label' => 'Image File',
                'rules' => 'uploaded[web_image]'
                    . '|is_image[web_image]'
                    . '|mime_in[web_image,image/jpg,image/jpeg,image/png,image/webp]'
                    . '|max_size[web_image,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            return view('upload_form', [
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $imageName = '';

        if ($img->isValid() && !$img->hasMoved()) {
            $imageName = $img->getRandomName();
            $img->move('uploads/', $imageName);
        }

        // Example DB insert (optional)
        $data = [
            'cid' => $cid,
            'web_title'  => $web_title,
            'web_image' => $imageName,
            'created_at' =>date('Y-m-d H:s:i'),
            'updated_at' =>date('Y-m-d H:s:i'), 
        ];

        // insert into DB here
        $table="admin_subcategory";
        $this->AppModel->insertAllData($table,$data);

        return redirect()->to('/subcategorylist')->with('success', 'SubCategory added successfully!');
    }
    function editsubcategory($sid = null)
    {
        $data['headerName'] = "EditSubCategory";
        $data['edisubcat'] = $this->AppModel->fetchEditSubcategoryData($sid);
        $table_name = "admin_category";
        $where_condition = array('cat_status' => 'Active');
        $data['categoryList'] = $this->AppModel->fetchAllData($table_name, $where_condition);
        
        return view('admin/edit/editsubcategory',$data);
    }
     function subcateditNew()
    {
        $web_title = $this->request->getPost('web_title');
        $cid   = $this->request->getPost('cid'); // ✅ FIXED
        $sid   = $this->request->getPost('sid');
        $img      = $this->request->getFile('web_image');
        $old_img  = $this->request->getPost('old_image');

        $imageName = '';

        // ✅ Image validation only if file uploaded
        if ($img && $img->isValid() && !$img->hasMoved()) {

            $validationRule = [
                'web_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[web_image]'
                        . '|mime_in[web_image,image/jpg,image/jpeg,image/png,image/webp]'
                        . '|max_size[web_image,2048]',
                ],
            ];

            if (!$this->validate($validationRule)) {
                return view('upload_form', [
                    'errors' => $this->validator->getErrors(),
                ]);
            }

            $imageName = $img->getRandomName();
            $img->move('uploads/', $imageName);
        }

        // ✅ Prepare data
        $data = [
            'cid'         => $cid,
            'web_title'   => $web_title,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        

        // ✅ Only update image if uploaded
        if (!empty($imageName)) {
            $data['web_image'] = $imageName;
        } else {
            $data['web_image'] = $old_img;
        }
        
        // ✅ Where condition
        $where_condition = array('sid' => $sid);
        $table_name = "admin_subcategory";

        // ✅ Update query (IMPORTANT)
        $this->AppModel->UpdateData($data,$table_name,$where_condition);

        // ✅ Redirect
        return redirect()->to('/subcategorylist')
                     ->with('success', 'SubCategory updated successfully!');
    }
    function delsubcategory($sid = null)
    {
        // ✅ Where condition
        $where_condition = array('sid' => $sid);
        $data = array('web_status' => 'InActive');
        $table_name = "admin_subcategory";

        // ✅ Update query (IMPORTANT)
        $this->AppModel->UpdateData($data,$table_name,$where_condition);

        // ✅ Redirect
        return redirect()->to('/subcategorylist')->with('success', 'SubCategory Deleted successfully!');
    }
    
   
   
}
