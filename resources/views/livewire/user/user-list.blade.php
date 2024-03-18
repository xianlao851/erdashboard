<div class="p-4">
    <div class="h-screen max-w-6xl p-1 mx-auto mt-4 bg-white rounded-md">
        <div class="relative h-10 border-b-2">
            <div class="absolute left-0 top-3">
                <h3 class="mx-1">Admin Dashboard</h3>
            </div>
            <div class="absolute top-0 right-0"> <label class="bg-gray-300 btn btn-sm hover:bg-gray-400" for="register"> <i
                        class="las la-plus-circle la-2x"></i></label></div>
        </div>
        <div class="">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>EMP ID:</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->emp_id }}</td>
                                <td class="uppercase">{{ $user->empInfo->fullname() }}</td>
                                <td class="uppercase">

                                    @foreach ($user->gethasRole as $roles)
                                        @foreach ($roles->getRole as $role)
                                            {{ $role->name }}
                                        @endforeach
                                        @if (!$loop->last)
                                            /
                                        @endif
                                    @endforeach
                                </td>
                                <td class="uppercase">
                                    <label class="btn btn-xs btn-primary" wire:key="$user-{{ $user->id }}"
                                        wire:click="viewRole({{ $user->id }})" for="view_role">ROLES</label>
                                    {{-- <label class="btn btn-xs btn-success">PERMISSION</label>
                                    <label class="btn btn-xs btn-accent">DELETE</label> --}}
                                </td>
                            @empty
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal-->

        <!--modals start-->

        <!--Register-->
        <input type="checkbox" id="register" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="max-w-4xl modal-box">
                <h3 class="text-lg font-bold">ADD USER!</h3>
                {{-- <x-validation-errors class="mb-4" /> --}}

                @csrf
                <div>
                    <x-label for="name" value="{{ __('Employee ID') }}" />
                    @error('emp_id')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                    <x-input id="emp_id"
                        class="block w-full mt-1 border-green-700 focus:border-green-700 focus:ring-green-700"
                        type="text" wire:model.defer='emp_id' name="emp_id" :value="old('emp_id')" required autofocus
                        autocomplete="emp_id" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Role') }}" />
                    @error('getRole')
                        <span class="text-red-500 error">{{ $message }}</span>
                    @enderror
                    <select id="getRole" wire:model.defer='getRole'
                        class="block w-full mt-1 border-green-700 rounded-md focus:border-green-700 focus:ring-green-700"
                        type="text" name="getRole">
                        <option value="">Select role</option>
                        @foreach ($this->roles as $role)
                            <option value="{{ $role->name }}" class="uppercase">{{ $role->name }}</option>
                        @endforeach

                    </select>
                </div>
                <!----->
                <div class="mt-4">
                    <x-label for="password" value="{{ __(' Password') }}" />
                    @error('password')
                        <span class="text-red-500 error">
                            {{ $message }}
                        </span>
                    @enderror
                    <input id="password" wire:model.defer='password' type="password"
                        class="form-control block w-full mt-1 border-green-700 focus:border-green-700 focus:ring-green-700 rounded-md @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">


                </div>
                <div class="form-group row">
                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="confirm_password" wire:model.defer='password_confirmation' type="password"
                            class="form-control block w-full mt-1 border-green-700 focus:border-green-700 focus:ring-green-700 rounded-md @error('password') is-invalid @enderror"
                            name="password_confirmation" required autocomplete="current-password">
                    </div>
                </div>

                <!------>
                <div class="modal-action">
                    <label for="" wire:click='saveUser' class="btn btn-sm">Save</label>
                    <label for="register" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div>
        <!--Register end-->

        <!-- view roles-->
        <input type="checkbox" id="view_role" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="max-w-2xl modal-box">
                <div class="relative">
                    <div class="join">
                        <h3 class="text-gray-700 join-item font-base">Name:&nbsp; </h3>
                        <p class="underline uppercase join-item">
                            @if ($this->getUser)
                                {{ $this->getUser->name }}
                            @endif
                        </p>
                    </div>
                    <div class="absolute top-0 right-0"><label class="mr-1 join-item">ROLES</label>
                    </div>
                </div>
                <div class="mt-1 border-b-2"></div>
                <div class="relative mt-2">
                    <div class="overflow-x-auto">
                        <table class="table table-xs w-60">
                            <thead>
                                <tr>
                                    <th>ROLES</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($getUserRoles)
                                    @forelse ($getUserRoles as $userRole)
                                        <tr>
                                            <td> {{ $userRole->name }}</td>
                                            <td>
                                                <label class="btn btn-warning btn-xs"
                                                    wire:key='$userRole-{{ $userRole->id }}'
                                                    wire:click="revokeRole('{{ $userRole->name }}')">REVOKE
                                                </label>
                                            </td>
                                        @empty
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="absolute top-0 right-0 join">
                        <div class="join">
                            <select type="text" id="role"
                                class="text-sm w-[210px] input input-sm input-bordered join-item" wire:model='role'>
                                <option class="uppercase">SELECT ROLE</option>
                                @if ($this->roles)
                                    @forelse ($this->roles as $role)
                                        <option value="{{ $role->name }}"> {{ $role->name }}</option>
                                    @empty
                                    @endforelse
                                @endif
                            </select>
                            <button class="rounded-r-full btn btn-sm btn-success join-item" wire:click='createRole'><i
                                    class="las la-plus la-2x"></i></button>
                        </div>
                    </div>
                </div> <!-- table-->
                <div class="modal-action">
                    <label for="view_role" class="btn btn-sm">Close!</label>
                </div>
            </div>
        </div><!-- view roles end-->
    </div>

    <!--script-->

    <!--script-->
</div>
