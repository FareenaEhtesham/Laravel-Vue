
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background: url('assets/img/photo1.png') center center;">
                <h3 class="widget-user-username text-right">{{this.form.name}}</h3>
                <h5 class="widget-user-desc text-right">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="assets/img/user3-128x128.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
            </div>

            <!-- tabs -->
            <div class="col-md-12">
            <div class="card p-5">
                    <form @submit.prevent="UpdateUser" class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input v-model="form.name" type="text" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input v-model="form.email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea v-model="form.experience" class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input v-model="form.skills" type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                        <div class="col-sm-12">
                        <input type="file" name="photo" @change="Picture" class="form-input">
                      </div>
                      </div>
                        <div class="form-group row">
                        <label for="passport" class="col-sm-2 col-form-label">Passport</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="passport" placeholder="Type Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
            </div> 
        </div>
           
</template>

<script>
import Form from "vform";
export default {
    data() {
        return {
            form: new Form({
                id:'',
                name: "",
                email: "",
                type: "",
                password: "",
                skills: "",
                experience: "",
                photo: "",
            })
        }
    },
    mounted() {
        this.LoadUsers();
    },

    methods:{
      Picture(e){
          console.log("fire");
      },
      UpdateUser(){
        this.form.put('api/profile/'+this.form.id);
      },

      LoadUsers(){
          axios.get('api/profile').then( ({data}) => {this.form.fill(data)});
    },

    }
};
</script>
