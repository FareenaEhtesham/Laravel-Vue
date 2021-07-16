<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button
                                @click="newModal"
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#addNewUser"
                            >
                                <i class="fas fa-users">Add New</i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Registered At</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <span class="tag tag-success">{{
                                            user.type | capitalize
                                        }}</span>
                                    </td>
                                    <td>{{ user.created_at | Date }}</td>
                                    <td>
                                            <a href="#" title="edit" @click="EditUser(user)">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button
                                                type="submit"
                                                title="delete"
                                                style="border: none; background-color:transparent; outline: none;"
                                                @click="DeleteUser(user.id)"
                                            >
                                                <i
                                                    class="fas fa-trash text-danger"
                                                ></i>
                                            </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div data-backdrop="static" class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content pt-10">
                    <h5 class="ml-auto mr-auto mt-4 heading">Add New User</h5>

                    <div class="modal-body">
                        <form @submit.prevent="editMode ? UpdateUser() : CreateUser()">
                            <div class="form-group">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    placeholder="Add Name"
                                    class="form-control"
                                />
                                <div
                                    v-if="form.errors.has('name')"
                                    v-html="form.errors.get('name')"
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    placeholder="Email"
                                    class="form-control"
                                />
                                <div
                                    v-if="form.errors.has('email')"
                                    v-html="form.errors.get('email')"
                                />
                            </div>
                            <div class="form-group">
                                <select
                                    v-model="form.type"
                                    type="text"
                                    name="type"
                                    placeholder="Type"
                                    class="form-control"
                                >
                                    <option value=""></option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>

                                <div
                                    v-if="form.errors.has('type')"
                                    v-html="form.errors.get('type')"
                                />
                            </div>

                            <div class="form-group">
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="form-control"
                                />
                                <div
                                    v-if="form.errors.has('password')"
                                    v-html="form.errors.get('password')"
                                />
                            </div>

                            <input
                                type="submit"
                                style="background-color: #0091b6"
                                class="btn btn-primary"
                                value="Create"
                                id="add"
                            />
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                                style="background-color: red"
                                @click="Reset"
                            >
                                Close
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end main child -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            editMode :false,
            users: {},
            form: new Form({
                id:'',
                name: "",
                email: "",
                type: "",
                password: ""
            })
        };
    },
    mounted() {
        this.LoadUsers();
        //every 3 seconds it send http request to update data
        // setInterval(() => this.LoadUsers(), 3000);

        Fire.$on("UserCreate", () => {
            this.LoadUsers();
            });
            //Fire.$on listen an event
    },

    methods: {
        UpdateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    Fire.$emit("UserCreate"); 
                    $("#addNewUser").modal("hide");

                    Toast.fire({
                        icon: "success",
                        title: "User update successfully"
                    });
                this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
        EditUser(user){
            this.editMode =true;
            $("#addNewUser").modal("show");
            this.form.fill(user); 
            $(".heading").html("Update User's Info");
            $("#add").val("Update");
        },
        Reset(){
            this.form.reset();//reset the form fields
            this.form.clear();// clear all the errors
        },
        newModal(){
            this.form.reset();
            this.editMode = false;
            $(".heading").html("Add New User");
            $("#add").val("Create");
        },
        DeleteUser(id){
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                this.form.delete("api/user/"+id)
                .then( () => {
                    swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    Fire.$emit("UserCreate");
                    })
                .catch( () => this.$Progress.fail());
            }
            })
        },
        CreateUser() {
            this.editMode =false;
            this.$Progress.start();
            this.form.post("api/user")
            .then( () => {
                Fire.$emit("UserCreate"); // after post a form create an event "UserCreate"
                $("#addNewUser").modal("hide");

                Toast.fire({
                    icon: "success",
                    title: "User add successfully"
                });

                this.$Progress.finish();
                })

            .catch( () => {
                this.$Progress.fail();
                });
            
        },

        LoadUsers() {
            axios.get("api/user").then(({ data }) => (this.users = data));
        }
    }
};
</script>
