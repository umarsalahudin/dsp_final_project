

<div class="container-fluid">
  <div class="row">
    <div>
      <table id="table" class="table" style="color:black; ">
        {{ csrf_field() }}
        <?php $no=1; $count=0;?>
        <thead style="background-color: #337ab7">
          <tr>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Category</th>
            <th>SubCategory</th>
            <th>Add & Delete Images</th>
            <th>Status</th>
            <th>Edit</th>
          </tr>
        </thead>
            <tr class="HR_">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><button class="btn btn-default"><a href="AddImage_Delete&{{$p->id}}">View Map</a></button></td>
            </tr>
      </table>
    </div>
  </div>
</div>

<script>
$("#AddProduct").click(function() {

  $.ajax({
    type: 'post',
    url: '/Product_store',
    data: {
      '_token': $('input[name=_token]').val(),
      'name_M': $('input[name=name_M]').val(),
      'brandname_M': $('input[name=brandname_M]').val(),
      'subcategory_M': $('select[name=subcategory_M]').val(),
      'description_M':$('textarea#description_M').val(),
    },
    success: function(data){
      $('#table').append("<tr id='HR_' class='HR_'><td>" + data.d.name+"</td><td>"+data.d.Brandname+"</td><td>"+data.cat.category+"</td><td>"+data.subcat.subcategory+"</td><td><button class='btn btn-default'><a href='AddImage_Delete&"+ data.d.id +"'>Add & Delete Image</a></button></td><td><button class='btn btn-default'><a href='statusproduct_P&"+ data.d.id +"'>"+data.d.status+"</a></button></td><td><button class='btn btn-default'><a onclick='map("++","++")'>Edit</a></button></td></tr>");
    },
  });
});

</script>

@endsection

  



   




















