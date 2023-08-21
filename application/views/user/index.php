<?php $this->load->view('includes/header'); ?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Product List</h5>
                <a href="#" class="btn btn-primary" style="float:left" data-toggle="modal" data-target="#exampleModal"><b>+</b></a>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ACTION</th>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th>IMAGE</th>
                            <th>PRICE</th>
                            <th>CURRENCY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($products as $row) { ?>
                        <tr>
                            <td class="options-column">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle options-btn" type="button" id="optionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #12AD2B;">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="optionsDropdown">
                                        <!-- <label class="dropdown-item file-label" for="imageInput<?=$row['id']?>">
                                            <i class="bi bi-image" style="color: #12AD2B;"></i> <span style="color: #12AD2B;">Image</span>
                                        </label> -->
                                        <input type="file" class="file-input" id="imageInput<?=$row['id']?>" style="display: none;">
                                        <a class="dropdown-item" href="<?=base_url()?>product/edit/<?=$row['id']?>"><i class="bi bi-image" style="color: #12AD2B;"></i> <span style="color: #12AD2B;">Image</span></a>
                                        <a class="dropdown-item" href="<?=base_url()?>product/delete/<?=$row['id']?>" onclick="return confirm('Are you sure want to delete this user ?')"><i class="bi bi-trash" style="color: #12AD2B;"></i> <span style="color: #12AD2B;">Delete</span></a>
                                    </div>
                                </div>
                            </td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['description']?></td>
                            <td><img src="<?= base_url('images/'.$row['image']) ?>" alt="Product Image" width="50px"></td>
                            <td><?=$row['price']?></td>
                            <td><?=$row['currency']?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success" role="alert">
                        Successfully Added
                    </div>
                <?php }
                ?>
                <?php
                if ($this->session->flashdata('deleted')) { ?>
                    <div class="alert alert-success" role="alert">
                        Successfully Deleted
                    </div>
                <?php }
                ?>
                 <?php
                if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger" role="alert">
                        Failed!
                    </div>
                <?php }
                ?>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <form action="<?= base_url() ?>product/add" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" placeholder="Name" class="form-control" id="name">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="description">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="0.0">
                    <label for="currency">Currency</label>
                    <input type="text" name="currency" id="currency" class="form-control" placeholder="enter currency">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-info" name="insert" value="Add Product">
            </div>
      </form>

      <?php
                if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success" role="alert">
                        Successfully Added
                    </div>
                <?php }
                ?>
                 <?php
                if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger" role="alert">
                        Failed!
                    </div>
                <?php }
        ?>

    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php $this->load->view('includes/footer'); ?>