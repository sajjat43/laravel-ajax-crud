<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container" style="padding:100px;">
        <div class="">
            <div class="row">
                {{-- <div class="col-md-6">
                    <button class="btn btn-success" onclick="load()">Fetch</button>
                </div> --}}
                <div class="col-md-6">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Create data
                    </button>

                </div>
            </div>



            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Details</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>

                <h1>Category List</h1>
                <tbody>

                </tbody>
            </table>


        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" id="upload_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="">Category Name:</label>
                        <input type="text" name="Cname" id="Cname" class="form-control">
                    </div>
                    <div class="modal-body">
                        <label for="">description</label>
                        <input type="text" name="Cdescription" id="Cdescription" class="form-control">
                    </div>
                    <div class="modal-body">
                        <label for="">image:</label>
                        <input type="file" name="Cimage" id="Cimage" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  id="submit" type="submit"  class="btn btn-primary upload-image">submit</button>
                </form>
                <span id="uploaded_image"></span>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="js/jquery-mod.js"></script>

    {{-- ========================== ajax query=================== --}}

    <script type="text/javascript">
//         $(document).ready(function(){    
//         getData()
//         clearData()
  
// })

//     function setData(){
//     var Cname = $("#Cname").val();
//     var Cdescription = $("#Cdescription").val();
//     var Cimage = $("#Cimage").val();

//     $("#submit").html('Please Wait...');
//     $("#submit"). attr("disabled", true);
//     $.ajax({
//         url:'{{route('ajax.category.create')}}',
//         data:{
//             _token:'{{csrf_token()}}',
//             Cname:Cname,
//             Cdescription:Cdescription,
//             Cimage:Cimage
//         },
//         method:'post',
//         success:function (response){
//             console.log(response);
//             window.location.reload();
//             $("#submit").html('Submit');
//             $("#submit"). attr("disabled", false);
//         }
//     })
// }


    function getData()
{
    $.ajax({
        url:'{{route('ajax.get')}}',
        method:'get',
        success:function (response){
            // clearData()
            for (data of response.data)
            {
                $('#myTable tbody').append('<tr>\
                    <td>'+data.id+'</td>\
                    <td>'+data.Cname+'</td>\
                    <td>'+data.Cdescription+'</td>\
                    <td><img src="uploads/category/'+data.Cimage+' " width="50px" height="50px"></td>\
                   <td> <button class="btn btn-sm btn-danger mr2" onclick="deleteCategory('+data.id+')">Delete</button></td>\
                     </tr>');
            }
        }
    })
}

// delete 

getData()

function clearData(){
    var Cname = $('#Cname').val('');
var Cdescription = $('#Cdescription').val('');
var Cimage = $('#Cimage').val('');
}
function deleteCategory(id){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:"/ajax/category/delete/"+id,
        success:function(category){
            console.log('delete category done');
            clearData();
            window.location.reload();   
            
        }
    })
}

$(document).ready(function(){
    $('#upload_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:'{{route('ajax.category.create')}}',
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                clearData()
                // getData()
            window.location.reload();
             $("#submit").html('Submit');
            $("#submit"). attr("disabled", false);
            $('#exampleModal').modal('hide');
            }
        })
    })
})
    </script>


</body>

</html>