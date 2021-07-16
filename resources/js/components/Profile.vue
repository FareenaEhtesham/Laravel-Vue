<style>
  .bootstrap-tagsinput {
    padding: 10px 15px;
    box-shadow: none;
    border-radius: 2px;
    background: #ecf0f5;
}

.bootstrap-tagsinput .tag {
    padding: 5px 12px;
    border-radius: 2px;
    line-height: 37px;
    margin-top: 5px;
    margin-right: 5px;
}

.bootstrap-tagsinput .tag [data-role="remove"] {
    margin-right: -5px;
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
    content: "\e8f6";
    padding: 0 2px;
    font-family: 'feather' !important;
}
.bootstrap-tagsinput {
    padding: 5px 10px;
    background: white;
    border: 1px solid #e3eaef;
    border-radius: 0.25rem;
    width: 100%;
}

.bootstrap-tagsinput .tag {
    background: #4680ff;
    color: #fff;
    border-radius: 0.25rem;
}
</style>
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
                <img class="img-circle" :src="GetProfilePhoto()" alt="User Avatar">
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
                          <input v-model="form.name" type="text" class="form-control" name="name" id="inputName" placeholder="Name">
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
                          <input v-model="form.skills" type="text" class="form-control" id="inputSkills" placeholder="Skills" data-role="tagsinput">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                        <div class="col-sm-12">
                        <input type="file" name="photo" @change="Picture" class="form-input">
                      </div>
                      </div>
                        <div class="form-group row">
                        <label for="passport" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" v-model="form.password" class="form-control" id="password" placeholder="Type Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" id="update_btn">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
            </div> 
        </div>
           
</template>

<script>

$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
  $("#update_btn").attr("disabled",false);
  if(e.which == 13) {
    e.preventDefault();
    return false;
  }
});

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
        Fire.$on("UpdateUser", () => {
          this.LoadUsers();
          });
    },

    methods:{
    
      GetProfilePhoto(){
        let photo ="img/profile/"+this.form.photo;
        return photo;
      }, 

      Picture(e){
          let file = e.target.files[0];// store particular file in a variable "file"
          console.log(file);
          let reader = new FileReader();

          if(file['size'] <= 192780 ){
            reader.onloadend = (e)=> {
           // console.log('RESULT', reader.result)
            this.form.photo = reader.result;
          }
            reader.readAsDataURL(file);
          }

          else{
            swal.fire(
                    'Oops!',
                    'Your File has exceed the limit',
                    'error'
                    )
        }    
      },

      UpdateUser(){
        this.$Progress.start();
        this.form.put('api/profile/'+this.form.id)
        .then( () => {
          Fire.$emit("UpdateUser"); 
               Toast.fire({
                        icon: "success",
                        title: "User update successfully"
                    });
        this.$Progress.finish();
        })
        .catch( () =>{
          this.$Progress.fail();
        });
        
      },

      LoadUsers(){
          $("#update_btn").attr("disabled", true);
          axios.get('api/profile').then( ({data}) => {this.form.fill(data)});
    },

    }
};
</script>
