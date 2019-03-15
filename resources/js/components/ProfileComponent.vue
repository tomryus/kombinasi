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
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Biodata Form</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="Email" id="" class="form-control">
                     </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="Nama" id="" class="form-control">
                     </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerajaan" id="" class="form-control">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
            profile:[]
        }
    },
    methods:{
        showModal()
        {
            $("#kelas-modal-form").modal("show");
        },
        getprofile(){
            axios.get('/profilevue')
            .then(response =>{
                this.profile=response.data.data_Profile; 
                console.log(this.profile);
                
        
            });
        }    
    },
    mounted(){
        this.getprofile();
    }
}
</script>

