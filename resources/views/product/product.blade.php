<!doctype html>
<html lang="en">

<head>

    {{--
    <meta name="csrf-token" content="{{ csrf_token()}}"> --}}
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
                <div class="col-sm-8">

                    <!-- Button trigger modal -->
                    <button type="button" id="editModal" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal">
                        Create Product
                    </button>

                </div>
            </div>


            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>

                <h1>product List</h1>
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
                    <h5 class="modal-title" id="addText">Add product</h5>
                    <h5 class="modal-title" id="updateText">Update product</h5>
                    <button type="button" class="close" data-dismiss="modal" id="closex" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)">
                    <div class="modal-body">
                        <label for="">Product Name:</label>
                        <input type="text" name="name" id="name" required class="form-control">
                    </div>
                    <div class="modal-body">
                        <label for="">description</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    <div class="modal-body">
                        <label for="">Quantity</label>
                        <input type="text" name="Qty" id="Qty" class="form-control" required>
                    </div>
                    <div class="modal-body">
                        <label for="">Price</label>
                        <input type="text" name="price" id="price" required class="form-control">
                    </div>
                    
                    <input type="hidden" id="id">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                        <button id="submit" onclick="addProduct()" type="submit" class="btn btn-primary">Create</button>
                        <button id="update" onclick="updateProduct()" type="submit"
                            class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="js/jquery-mod.js"></script>

    {{-- ========================== ajax query=================== --}}
    <script>
        $('#addText').show();
        $('#submit').show();  
        $('#updateText').hide();
        $('#update').hide();

function allData(){
    $.ajax({
        type:"GET",
        dataType:'json',
        url:"{{route('product.view')}}",
        success:function(response){
            var product =""
            $.each(response,function(key,value){
                
                product =product + "<tr>"
                product =product + "<td>"+value.id+"</td>"
                product =product + "<td>"+value.name+"</td>"
                product =product + "<td>"+value.description+"</td>"
                product =product + "<td>"+value.Qty+"</td>"
                product =product + "<td>"+value.price+"</td>"
                
                product =product + "<td>"
                product =product + "<button class='btn btn-sm btn-primary mr2' onclick='editProduct("+value.id+")' >Edit</button>"
                product =product + "<button class='btn btn-sm btn-danger mr2' onclick='deleteProduct("+value.id+")'>Delete</button>"
                product =product + "<td>"
                product =product + "<tr>"
            })
            $('tbody').html(product);
        }
    })
}
allData();
function clearData(){
var name = $('#name').val('');
var description = $('#description').val('');
var Qty = $('#Qty').val('');
var price = $('#price').val('');
}
 function addProduct(){
var name = $('#name').val();
var description = $('#description').val();
var Qty = $('#Qty').val();
var price = $('#price').val();
// var image = $('#image').val();

$.ajax({
    type:"POST",
    dataType:"json",
    data:{
        "_token":"{{csrf_token()}}",
        name:name,
        description:description,
        Qty:Qty,
        price:price},
    url: "{{route('product.store')}}",
    success:function(data){ 
        clearData();
        allData(); 
        $('#exampleModal').modal('hide');
        $('#close').show();
           $('#closex').show();

       

    }
})

 }

//  --------- edit product------

function editProduct(id){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:"/edit/product/"+id,
        success: function(product){
           $('#addText').hide();
           $('#submit').hide();
           $('#updateText').show();
           $('#update').show();
           $('#name').val(product.name);
           $('#description').val(product.description);
           $('#Qty').val(product.Qty);
           $('#price').val(product.price);  
           $('#id').val(product.id);
           $('#exampleModal').modal('show');
           $('#close').hide();
           $('#closex').hide();
            console.log(product);
        }
    })
}
function  updateProduct(){
    var id =$('#id').val();
    var name = $('#name').val();
    var description = $('#description').val();
    var Qty = $('#Qty').val();
    var price = $('#price').val();

    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            "_token":"{{csrf_token()}}",
        name:name,
        description:description,
        Qty:Qty,
        price:price
    },
    url:"/product/update/"+id,
    success: function (product){
        clearData();
        allData();
        $('#exampleModal').modal('hide');
        $('#addText').show();
        $('#submit').show();
        $('#updateText').hide();
        $('#update').hide();
        console.log('product update successfully');
        
    },
      
    })
}
// -----------delete --- product ------- 

function deleteProduct(id){
    $.ajax({
        type:"GET",
        dataType:"json",
        url: "/product/delete/"+id,
        success:function(product){
            console.log('deleted');
            allData();
        }
    })
}

    </script>
</body>

</html>