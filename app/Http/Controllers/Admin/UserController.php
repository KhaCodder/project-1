<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface as AddressRepository;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userService;

    protected $userRepository;

    protected $addressRepository;

    public function __construct(UserService $userService, UserRepository $userRepository, AddressRepository $addressRepository) {
        // $this->middleware('permission:view_all_users', ['only' => ['index']]);
        // $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit_all_users', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete_all_users', ['only' => ['destroy']]);

        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'nullable|string|max:255',
            'sort_by' => 'nullable|in:name,email,created_at,id',
            'sort_direction' => 'nullable|in:asc,desc',
        ]);

        $filterParams = [
            'conditions' => $request->only('keyword', 'start_date', 'end_date'),
            'sort' => $request->only('sort_by', 'sort_direction')
        ];
        $users = $this->userService->listAllPaginated($filterParams);
        return view('backend.admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $roles = Role::pluck('name', 'name')->all();
        $paymentMethods = PaymentMethod::all();

        return view('backend.admin.user.create', compact('roles', 'paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:6|max:32',
            'payment_method' => 'string',
            'fields.*' => 'string',
        ]);
        
        DB::beginTransaction();
        
        try {
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password)
            ]);
    
            $this->addressRepository->create([
                'user_id' => $user->id,
                'fullname' => $request->input('fullname'),
                'number_phone' => $request->input('phone_number'),
                'address_1' => $request->input('address_1'),
                'address_2' => $request->input('address_2'),
                'region' => $request->input('region'),
                'city' => $request->input('city'),
                'zipcode' => $request->input('zipcode'),
            ]);            
            $user->syncRoles($request->role);

            if($request->has('payment_method') && !empty($request->payment_method)) {
                $user->paymentMethod()->create(['payment_method_id' => $request->payment_method, 'details' => json_encode($request->fields)]);
            }
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Người dùng <b>'.$user->name.'</b> đã được tạo thành công..!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Thêm người dùng không thành công, hãy thử lại...');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $_data = $this->userService->show($request, $id);
        $data = $_data;
        
        return view('backend.admin.user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $user = $this->userRepository->findById($id, ['*'], ['address']);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $paymentMethods = PaymentMethod::all();

        return view('backend.admin.user.edit', compact('user', 'userRoles', 'roles', 'paymentMethods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $this->userRepository->findById($id);
        
        $rules = [
            'name' => 'required|string|max:250',
            'email' => 'required|string|email',
        ];

        if ($user->name != $request->name) {
            $rules['name'] .= '|unique:users';
        }
        if ($user->email != $request->email) {
            $rules['email'] .= '|unique:users';
        }
    
        $request->validate($rules);
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $userData['password'] = Hash::make($request->password);
        }
        
        $this->userRepository->update($id, $userData);
        
        $this->addressRepository->updateOrInsert(['user_id' => $id], [
            'fullname' => $request->input('fullname'),
            'number_phone' => $request->input('phone_number'),
            'address_1' => $request->input('address_1'),
            'address_2' => $request->input('address_2'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
        ]); 

        $user->syncRoles($request->role);
        if (empty($user->paymentMethod)) {
            $user->paymentMethod()->create(['payment_method_id' => $request->payment_method, 'details' => json_encode($request->fields)]);
        } else {
            $user->paymentMethod->payment_method_id = $request->payment_method;
            $user->paymentMethod->details = json_encode($request->fields);
            $user->paymentMethod->save();
        }
        
        return redirect()->back()->with('success', 'Người dùng <b>'.$user->name.'</b> đã cập nhật thành công..!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}