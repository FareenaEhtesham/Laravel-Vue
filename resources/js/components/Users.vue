<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button
                                class="btn btn-success"
                                data-toggle="modal"
                                data-target="#addNewUser"
                            >
                                <i class="fas fa-users">Add New</i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
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
                                        <form action="" method="POST">
                                            <a href="#" title="edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button
                                                type="submit"
                                                title="delete"
                                                style="border: none; background-color:transparent; outline: none;"
                                                onclick="return confirm('Are you sure you want to delete this?')"
                                            >
                                                <i
                                                    class="fas fa-trash text-danger"
                                                ></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div
            data-backdrop="static"
            class="modal fade"
            id="addNewUser"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content pt-10">
                    <h5 class="ml-auto mr-auto mt-4">Add New User</h5>

                    <div class="modal-body">
                        <form @submit.prevent="CreateUser">
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
                                name="add"
                                id="add"
                            />
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                                style="background-color: red"
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
import Form from "vform";
export default {
    data() {
        return {
            users: {},
            form: new Form({
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
        setInterval(() => this.LoadUsers(), 3000);
    },

    methods: {
        CreateUser() {
            this.$Progress.start();
            this.form.post("api/user");
            $("#addNewUser").modal("hide");
            this.$Progress.finish();

            Toast.fire({
                icon: "success",
                title: "User add successfully"
            });
        },

        LoadUsers() {
            axios.get("api/user").then(({ data }) => (this.users = data));
        }
    }
};
</script>
