@extends('adminpanel/home')
@section('content')

  <!-- End Navbar -->
  <div class="content">
    <div class="container-fluid">
      <h1>Products Page</h1>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header card-header-primary text-center">
                              <h4 class="card-title ">Products List</h4>
                              <span id="updatemsg"></span><span id="deletemsg"></span>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table text-center">
                                  <thead class=" text-primary">
                                    <th>
                                      ID
                                    </th>
                                    <th>
                                      Product Name
                                    </th>
                                    <th>
                                      Brand
                                    </th>
                                    <th>
                                      Price
                                    </th>
                                    <th>
                                      Qty
                                    </th>
                                    <th>
                                        Alert Stock
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                  </thead>
                                  <tbody id="tableBody">
                                    {{-- <td>{{$loop->iteration}}</td> --}}
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header card-header-primary text-center">
                                <h4 class="card-title">Adding Products</h4>
                                <span id="successMsg"></span>
                            </div>
                            <div class="card-body text-center">
                                <form name="myForm">
                                    <div class="form-group">
                                        <input type="text" name="product_name" id="product_name" placeholder="Product Name" class="form-control">
                                        <span id="productError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="brand" id="brand" placeholder="Brand Name" class="form-control">
                                        <span id="brandError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="price" id="price" placeholder="Price" class="form-control">
                                        <span id="priceError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="qty" id="qty" placeholder="Quantity" class="form-control">
                                        <span id="qtyError"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="stock" id="stock" placeholder="Stock" class="form-control">
                                        <span id="stockError"></span>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="description" id="description" cols="30" rows="3" placeholder="Description" class="form-control"></textarea>
                                        <span id="descriptionError"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i>  Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
<div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update Product Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form name="editForm" class="editModal">
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="product_name" id="product_name" placeholder="Product Name" class="form-control">
                    <span id="productError"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="brand" id="brand" placeholder="Brand Name" class="form-control">
                    <span id="brandError"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="price" id="price" placeholder="Price" class="form-control">
                    <span id="priceError"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="qty" id="qty" placeholder="Quantity" class="form-control">
                    <span id="qtyError"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="stock" id="stock" placeholder="Stock" class="form-control">
                    <span id="stockError"></span>
                </div>
                <div class="form-group">
                    <textarea name="description" id="description" cols="30" rows="3" placeholder="Description" class="form-control"></textarea>
                    <span id="descriptionError"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection


@section('script')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    console.log("Hello Axios");
    let tableBody = document.getElementById("tableBody");
    const productnameList = document.getElementsByClassName("productnameList");
    const brandList = document.getElementsByClassName("brandList");
    const priceList = document.getElementsByClassName("priceList");
    const qtyList = document.getElementsByClassName("qtyList");
    const stockList = document.getElementsByClassName("stockList");
    const descriptionList = document.getElementsByClassName("descriptionList");

    const idList = document.getElementsByClassName("idList");
    const btnList = document.getElementsByClassName("btnList");

    // console.log(productnameList);
    // READ
    axios.get('/api/products')
         .then(response=>{

            //  console.log(response.data);
             response.data.products.forEach(element => {
                // console.log(element.product_name);
                // tableBody.innerHTML += ' <tr><td>'+element.id+'</td><td>'+element.product_name+'</td><td>'+element.brand+'</td><td>'+element.price+'</td><td>'+element.quantity+'</td><td>'+element.alert_stock+'</td><td>'+element.description+'</td><td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalCenter" onclick="editBtn('+element.id+')"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm" onclick="deleteBtn('+element.id+')"><i class="fas fa-trash"></i></button></td></tr>';
                displayData(element);
             });

         })
         .catch(error=>console.log(error));


         //CREATE
         let dataForm = document.forms['myForm'];
         let product_nameInput = dataForm['product_name'];
         let brandInput = dataForm['brand'];
         let priceInput = dataForm['price'];
         let qtyInput = dataForm['qty'];
         let stockInput = dataForm['stock'];
         let descriptionInput = dataForm['description'];

         dataForm.onsubmit = event=>{
             event.preventDefault();
            axios.post('/api/products',{
                product_name:product_nameInput.value,
                brand:brandInput.value,
                price:priceInput.value,
                qty:qtyInput.value,
                stock:stockInput.value,
                description:descriptionInput.value,
            })
                 .then(response=>{
                        let productError = document.getElementById('productError');
                        let brandError = document.getElementById('brandError');
                        let priceError = document.getElementById('priceError');
                        let qtyError = document.getElementById('qtyError');
                        let stockError = document.getElementById('stockError');
                        let descriptionError = document.getElementById('descriptionError');

                     if (response.data.msg=='Data Created Successfully!') {

                        document.getElementById('successMsg').innerHTML = '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>'+response.data.msg+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

                        dataForm.reset();
                        // tableBody.innerHTML += ' <tr><td>'+response.data[0].id+'</td><td>'+response.data[0].product_name+'</td><td>'+response.data[0].brand+'</td><td>'+response.data[0].price+'</td><td>'+response.data[0].quantity+'</td><td>'+response.data[0].alert_stock+'</td><td>'+response.data[0].description+'</td><td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalCenter" onclick="editBtn('+response.data[0].id+')"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm" onclick="deleteBtn('+response.data[0].id+')"><i class="fas fa-trash"></i></button></td></tr>';
                        displayData(response.data.createdData);
                        productError.innerHTML = brandError.innerHTML = priceError.innerHTML = qtyError.innerHTML = stockError.innerHTML = descriptionError.innerHTML = '';

                     }else{
                        console.log(response.data.msg.product_name);
                        console.log(response.data.msg.brand);


                        // if (product_nameInput.value=='') {
                        //     productError.innerHTML='<i class="text-danger">'+response.data.msg.product_name+'</i>';
                        // }else{
                        //     productError.innerHTML='';
                        // }

                        // Ternary Operator ::: productError.innerHTML = condition ? first : second;
                        productError.innerHTML = product_nameInput.value==''?'<i class="text-danger">'+response.data.msg.product_name+'</i>':'';

                        if (brandInput.value=='') {
                            brandError.innerHTML='<i class="text-danger">'+response.data.msg.brand+'</i>';
                        }else{
                            brandError.innerHTML = '';
                        }

                        if (priceInput.value=='') {
                            priceError.innerHTML='<i class="text-danger">'+response.data.msg.price+'</i>';
                        } else {
                            priceError.innerHTML='';
                        }

                        if (qtyInput.value == '') {
                            qtyError.innerHTML='<i class="text-danger">'+response.data.msg.qty+'</i>';
                        } else {
                            qtyError.innerHTML = '';
                        }

                        if (stockInput.value=='') {
                            stockError.innerHTML='<i class="text-danger">'+response.data.msg.stock+'</i>';
                        } else {
                            stockError.innerHTML = '';
                        }

                        if (descriptionInput=='') {
                            descriptionError.innerHTML='<i class="text-danger">'+response.data.msg.description+'</i>';
                        } else {
                            descriptionError.innerHTML = '';
                        }

                     }
                 })
                 .catch(error=>{
                     console.log(error.response);
                 });
            // console.log("It's work.");
            // console.log(product_nameInput.value);
            // console.log(brandInput.value);
         };



        //  Edit
            let editForm = document.forms['editForm'];
            let product_nameEdit = editForm['product_name'];
            let brandEdit = editForm['brand'];
            let priceEdit = editForm['price'];
            let qtyEdit = editForm['qty'];
            let stockEdit = editForm['stock'];
            let descriptionEdit = editForm['description'];
            let productIDforUpdate;
            let oldProductName;



        function editBtn(productID){
            productIDforUpdate = productID;
            axios.get('api/products/'+productID)
                 .then(response=>{
                    //  console.log(response.data);
                     product_nameEdit.value = response.data.product_name;
                     brandEdit.value = response.data.brand;
                     priceEdit.value=response.data.price;
                     qtyEdit.value=response.data.quantity;
                     stockEdit.value=response.data.alert_stock;
                     descriptionEdit.value=response.data.description;

                     oldProductName = response.data.product_name;
                 })
                 .catch(error=>{
                     console.log(error);
                 });
        }


        //  Update
        editForm.onsubmit = event=>{
            event.preventDefault();
            console.log("Update");
            console.log(productIDforUpdate);
                axios.put('api/products/'+productIDforUpdate,{
                    name:product_nameEdit.value,
                    brand:brandEdit.value,
                    price:priceEdit.value,
                    qty:qtyEdit.value,
                    stock:stockEdit.value,
                    detail:descriptionEdit.value,
                })
                     .then(response=>{

                        document.getElementById('updatemsg').innerHTML = '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>'+response.data.msg+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

                        $('.editModal').modal('hide')
                        $('#editModalCenter').modal('hide')

                        // console.log(oldProductName);

                        for (let i = 0; i < productnameList.length; i++) {
                            if (productnameList[i].innerHTML == oldProductName) {
                                productnameList[i].innerHTML=product_nameEdit.value;
                                brandList[i].innerHTML = brandEdit.value;
                                priceList[i].innerHTML = priceEdit.value;
                                qtyList[i].innerHTML = qtyEdit.value;
                                stockList[i].innerHTML = stockEdit.value;
                                descriptionList[i].innerHTML = descriptionEdit.value;
                            }

                        }
                     })
                     .catch(error=>console.log(error));
        }


        //Delete
        function deleteBtn(productID){
            // console.log(productID);

            if (confirm("Sure to delete??")) {
                axios.delete('api/products/'+productID)
                 .then(response=>{
                     document.getElementById('deletemsg').innerHTML = '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>'+response.data.msg+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                     for (let i = 0; i < productnameList.length; i++) {
                         if (productnameList[i].innerHTML==response.data.deletedProducts.product_name) {
                             idList[i].style.display = 'none';
                            productnameList[i].style.display='none';
                            brandList[i].style.display='none';
                            priceList[i].style.display='none';
                            qtyList[i].style.display='none';
                            stockList[i].style.display='none';
                            descriptionList[i].style.display='none';
                            btnList[i].style.display='none';
                         }

                     }

                 })
                 .catch(error=>console.log(error));
            }
        }


        //Helper Function
        function displayData(data){
            tableBody.innerHTML += ' <tr><td class="idList">'+data.id+'</td><td class="productnameList">'+data.product_name+'</td><td class="brandList">'+data.brand+'</td><td class="priceList">'+data.price+'</td><td class="qtyList">'+data.quantity+'</td><td class="stockList">'+data.alert_stock+'</td><td class="descriptionList">'+data.description+'</td><td class="btnList"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalCenter" onclick="editBtn('+data.id+')"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm" onclick="deleteBtn('+data.id+')"><i class="fas fa-trash"></i></button></td></tr>';
        }




</script>

@endsection

{{--
    Title-List
    Old Title
    New Title

    if(titleList[array].title == oldTitle){
        titleList[array].title = newTitle;
    }

--}}


