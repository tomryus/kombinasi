<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <button @click="showModal()" class="btn btn-info btn-sm float-right" >Tambah data</button>
                        Data</div>

                    <div class="card-body">
                    <table class="table table-bordered table-stripped table-responsive" >
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>email</th>
                                <th>nama</th>
                                <th>pekerjaan</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(profile,index) in profile" :key="index">
                                <td>{{index +1}}</td>
                                <td>{{profile.email}}</td>
                                <td>{{profile.nama}}</td>
                                <td>{{profile.pekerjaan}}</td>
                                <td>
                                    <a href="#"><button class="btn btn-info btn-sm" >Tambah Data</button></a>
                                    <a href="#"><button class="btn btn-danger btn-sm">Hapus Data</button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kelas-modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" v-if="errors.length > 0">
                        <ul>
                            <li v-for="(error, index ) in errors" :key="index">{{error}}</li>
                        </ul>
                    </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Form</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" v-model="profiles.email" name="Email" id="" class="form-control">
                     </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" v-model="profiles.nama" name="Nama" id="" class="form-control">
                     </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" v-model="profiles.pekerjaan" name="pekerajaan" id="" class="form-control">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="resetForm()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="addprofile()" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            profile:[],
            profiles:{
                email : '',
                nama : '',
                pekerjaan : '',
                
            },
            errors : [],
        }
    },
    methods:{
        showModal()
        {
            $("#kelas-modal-form").modal("show");
            this.errors=[];
        },
        getprofile(){
            axios.get('/profilevue')
            .then(response =>{
                this.profile=response.data.data_Profile; 
                console.log(this.profile);
                
        
            });
        },
        addprofile(){
            axios.post('/profilevue',{
                email : this.profiles.email,
                nama : this.profiles.nama,
                pekerjaan : this.profiles.pekerjaan,
            })
            .then(response =>{
                this.getprofile();
                $("#kelas-modal-form").modal("hide");
                this.resetForm();
                
            })
            .catch(error=>{
                this.errors = [];
                if(error.response.data.errors.email){
                    this.errors.push(error.response.data.errors.email[0])
                }
                if(error.response.data.errors.nama){
                    this.errors.push(error.response.data.errors.nama[0])
                }
                if(error.response.data.errors.pekerjaan){
                    this.errors.push(error.response.data.errors.pekerjaan[0])
                }
            });
            
        },
        resetForm(){
            this.profiles.nama = ' ' ,
            this.profiles.email = ' ' ,
            this.profiles.pekerjaan = ' ' 
            }

    },
    mounted(){
        this.getprofile();
    }
}
</script>

