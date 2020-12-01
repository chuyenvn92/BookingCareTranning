<div id="app">
    <input type="hidden" name="edit_id" value="<?php echo filter_input(INPUT_GET, 'id') ?>" />
    <h1 class="mt-4">Quản lý Bệnh viện</h1>
    <div class="alert alert-success" v-if="new_response">
        {{new_response.message}}
    </div>
    <button v-on:click="addHospital()" class="btn btn-primary mb-4 ml-4">
        <i class="fas fa-plus mr-1"></i>Thêm mới
    </button>
    <div class="card mb-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Tên</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Giới thiệu</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="hospital in hospitals">
                            <td>{{ hospital.ten }}</td>
                            <td>{{ hospital.diachi }}</td>
                            <td>{{ hospital.gioithieu }}</td>
                            <td>
                                <a class="btn btn-primary" title="Sửa" href="#" v-on:click="editHospital(hospital)"><i class="fas fa-edit mr-1"></i>Sửa</a>
                                <a class="btn btn-danger" href="#" title="Xóa" v-on:click="deleteHospital(hospital)"><i class="far fa-trash-alt mr-1"></i>Xóa</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Modal Create Hospital--> 
    <div class="modal fade" id="newHospitalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="POST" id="newHospitalForm"  data-action="<?php echo $this->createUrl("add") ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="new_response.data">
                            <div v-for="errorList in new_response.data">
                                <div v-for="error in errorList" class="alert alert-danger">
                                    {{error}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tên</label>
                            <input type="text" name="ten" class="form-control" placeholder="Nhập tên bệnh viện">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Địa chỉ</label>
                            <input class="form-control" name="diachi" type="text" placeholder="Địa chỉ">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Giới thiệu</label>
                            <input class="form-control" name="gioithieu" type="text" placeholder="Giới thiệu">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" v-on:click="submitHospital()" class="btn btn-primary">Thêm mới</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Edit Modal-->
    <div class="modal fade" id="editHospitalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="POST" id="editHospitalForm"  data-action="<?php echo $this->createUrl("update") ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa Bệnh viện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="hospital">
                        <div class="form-group">
                            <label class="col-form-label">Tên</label>
                            <input type="text" name="ten" class="form-control" v-model="hospital.ten">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Địa chỉ</label>
                            <input class="form-control" name="diachi" type="text" v-model="hospital.diachi">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Giới thiệu</label>
                            <input class="form-control" name="gioithieu" type="text" v-model="hospital.gioithieu">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" v-on:click="submitEditHospital()" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Delete Modal-->
    <div class="modal fade" id="deleteHospitalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="POST" id="deleteHospitalForm"  data-action="<?php echo $this->createUrl("delete") ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa bệnh viện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="hospital">
                        <h3>Bạn chắc chắn muốn xóa Bệnh viện "{{hospital.ten}}" chứ ???</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" v-on:click="submitDeleteHospital()" class="btn btn-primary">Xóa</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            hospitals: [],
            hospital: {},
            new_response: ''
        },
        methods: {
            getHospital: function(){
                var that = this;
                $.get("<?php echo $this->createUrl("benhvien") ?>", function(res){
                    that.hospitals = res.data;
                });
            },
            addHospital(){
                $('#newHospitalModal').modal();
            },
            editHospital(obj){
                this.hospital = obj;
                $('#editHospitalModal').modal();
            },
                   
            editHospitalServer(obj){
                console.log(obj);
                $('#editHospitalModal').modal();
            },
            submitEditHospital(){
                var that = this;
                var action = $('#editHospitalForm').attr('data-action');    
                $.post(action, this.hospital, function(response){
                    that.new_response = response;
                    if(response.code === 200)
                        {
                            $('#editHospitalModal').modal('hide');
                        }
                });
                        
            },
            deleteHospital(obj){
                this.hospital = obj;
                $('#deleteHospitalModal').modal();
            },
            submitDeleteHospital(){
                var that = this;
                var action = $('#deleteHospitalForm').attr('data-action');
                $.post(action, this.hospital, function(res){
                    that.new_response = res;
                    if(res.code === 200)
                    {
                        $('#deleteHospitalModal').modal('hide');
                        that.getHospital();
                    }
                });
            },
            submitHospital()
            {
                let form = document.getElementById('newHospitalForm');
                var data = new FormData(form);
                var that = this;
                var action = $('#newHospitalForm').attr('data-action');              
                $.ajax({
                        processData: false,
                        contentType: false,
                      method: "POST",
                      url: action,
                      data: data
                    })
                      .done(function( response ) {
                        that.new_response = response;
                
                        if(response.code === 200)
                            {
                                that.getHospital();
                                $('#newHospitalModal').modal('hide');
                                $('#newHospitalForm')[0].reset();
                                $('#newHospitalModal').button('reset');
                            }
                      });
                
            }
//            getId: function(){
//            var that = this;
//            $.get("<?php // echo $this->createUrl("getid")      ?>" , function(res){
//            that.hospitals = res.data;
//                });
//            },
//            postHospital()
//            {
//                var action = $('#newHospitalForm').attr('data-action');
//                var data = {
//                    ten : $('[name="ten"]').val(),
//                    diachi : $('[name="diachi"]').val(),
//                    gioithieu : $('[name="gioithieu"]').val()
//                };
//                console.log(action);
//                var that = this;
//                $.post(action, data, function(response){
//                    that.new_response = response;
//                    
//                    if(response.code == 200)
//                    {
//                        that.getHospital();
//                        $('#newHospitalModal').modal('hide');
//                    }
//                });
//                
//            },
        }
    });
    app.getHospital();
</script>