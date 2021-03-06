@extends('temp._layout')

@section('content')
    <div class="detail">
        <el-form ref="form" :model="form" label-width="80px">
            @include('temp._detail')
            <div class="operation">
                <el-button type="primary" @click="onSubmit">修改</el-button>
                <el-button @click="onCancel">取消</el-button>
                <a href="/temps">
                    <el-button>返回</el-button>
                </a>
            </div>
        </el-form>
    </div>

@endsection

@section('script')
    <script>
        var js_data = @json($js_data);
        var mixin = {
            data: {
                'detail_data': js_data.detail_data,
                'init_table_data': {},
                'is_disabled_edit': false,
                'form': {}
            },
            created:function(){
                let _this = this
                this.init_table_data = _this.table_data
            },
            methods: {
                onSubmit() {
                    // @todo 处理提交
                    axios.put('/api/temps/2', this.detail_data).then((response) => {
                        var message_type = 'error';
                          if (200 == response.data.code) {
                              var message_type = 'success';
                          } else {
                              console.log(response);
                          }
                          this.$message({
                              message: response.data.msg,
                              type: message_type
                          });
                    }).catch(error => console.log(error));
                },
                onCancel() {
                    // @todo 处理引用传递问题
                    this.detail_data = this.init_table_data
                }
            }
        }
    </script>
    @parent
@endsection