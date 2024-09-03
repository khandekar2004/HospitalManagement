<!DOCTYPE html>
<html>
<head>
<title>GeeksForGeeks Sweet alert</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <button type="button" onloadstart="sweet()" >Sweet</button>
    <button type="button" onclick="confirm()">confirm</button>
<script>

    function confirm(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    <?php
    
        ?>
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
    }
</script>
</body>
</html>
