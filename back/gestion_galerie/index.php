<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_panel_admin.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <title>Document</title>
</head>
<body>
    <section>

        <div class="container">
            <div class="title-page">
                <h1 class="title">Gestion De La galerie</h1>
            </div>
            <div class="btn-add">
                <button type="button" id="add_button" class="add-btn">Add</button>
            </div>
            <table class="table_data" id="gallery_data">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>titre</th>
                        <th>image</th>
                        <th>editer</th>
                        <th>effacer</th>
                    </tr>
                </thead>
            </table>
        </div>


    </section>

    <div id="memberModal">
        <form method="post" id="member_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close">&times;</button>
                    <h4 class="modal-title"> Ajout Gallery</h4>
                </div>
                <div class="modal-body">
                    <label for="titre">taper votre titre</label>
                    <input type="text" name="titre" id="titre" >
                    <label for="image">taper votre image</label>
                    <input type="file" name="image" id="image" >
                </div>
                <div class="modal-footer">
					<input type="hidden" name="id" id="id" />
                    <input type="hidden" name="operation" id="operation" value="Add">
                    <input type="submit" name="action" id="action" value="Add">
                </div>
            </div>
        </form>
    </div>


    <script type="text/javascript" language="javascript">

        $(document).ready(function(){

            $('#add_button').click(function(){
                $('#memberModal').css('display', 'block');
                $('#member_form')[0].reset();
                $('.modal-title').text("Ajouter une photo");
                $('#action').val("Add");
                $('#operation').val("Add");
                $('#image').html('');
                
        });

            // recup des donnée bdd
            var dataTable = $('#gallery_data').DataTable({
                    "processing":true,
                    "serverSide":true,
                    "searching": false,
                    "paging": false,
                    "ordering": false,
                    "language": {"info": ""},
                    "order":[],
                    "ajax":{
                        url:"find.php",
                        type:"POST"
                    },

                    

                });

            
            // ajout nouveau ficier en bdd
            $(document).on('submit', '#member_form', function(event){
                event.preventDefault();
                var titre = $('#titre').val();
                var etx = $('#image').val().split('.').pop().toLowerCase();
                if(etx != '')
                {
                    if(jQuery.inArray(etx, ['gif','png','jpg','jpeg']) == -1)
                    {
                        alert("Invalid galerie photo format");
                        $('#image').val('');
                        return false;
                    }
                }	

                if(titre != '' )
                {
                    $.ajax({
                        url:"insert_update.php",
                        method:'POST',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            alert(data);
                            $('#member_form')[0].reset();
                            $('#memberModal').css('display', 'none');
                            dataTable.ajax.reload();
                            window.location.href = './index.php';
                        }
                    });
                }
                    else
                    {
                        alert("Obligatoire de remplir tout le formulaire");
                    }
            });

            // Modif en bdd

            $(document).on('click', '.update', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"findOne.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"json",
                    success:function(data)
                    {
                        $('#memberModal').css('display', 'block');
                        $('#titre').val(data.titre);
                        $('#image').html(data.image);
                        $('.modal-title').text("Edit Gallery");
                        $('#id').val(id);
                        $('#action').val("Edit");
                        $('#operation').val("Edit");
                        
                    }
                })
            });



            // suppression

                $(document).on('click', '.delete', function(){
                var id = $(this).attr("id");
                if(confirm("Êtes-vous sûr de vouloir supprimer ce galerie ?"))
                {
                    $.ajax({
                        url:"delete.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data)
                        {
                            alert(data);
                            dataTable.ajax.reload();
                            window.location.href = './index.php';
                        }
                    });
                }
                else
                {
                    return false;	
                }
            });

            // fermeture de la modal
            $(document).on('click', '.close', function(){
                $('#memberModal').css('display', 'none'); //essayer de remplacer cette ligne par $('#memberModal').hide();
            });
        });


    </script>

</body>
</html>