<div class="banner">
  <div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">
    <!-- Wrapper-for-Slides -->
    <div class="carousel-inner" role="listbox"> 
      <!-- First-Slide -->
      <?php 
        $slide1 = $this->db->query("SELECT * FROM t_slide WHERE id_slide = '1'"); 
        $row1 = $slide1->row_array();
        $slide2 = $this->db->query("SELECT * FROM t_slide WHERE id_slide = '2'"); 
        $row2 = $slide2->row_array();
        $slide3 = $this->db->query("SELECT * FROM t_slide WHERE id_slide = '3'"); 
        $row3 = $slide3->row_array();
      ?>
      <div class="item active">
        <div class="banner-img" style="background: url('<?=base_url()?>assets/uploads/slide/<?=$row1['gambar_slide']?>')no-repeat center;background-size: cover;"> 
          <div class="carousel-caption kb_caption">
            <!-- <h3 data-animation="animated flipInX">Real estate</h3>   -->
          </div>
        </div>
      </div> 

      <!-- Second-Slide -->
      <div class="item">
        <div class="banner-img banner-img1" style="background: url('<?=base_url()?>assets/uploads/slide/<?=$row2['gambar_slide']?>')no-repeat center;background-size: cover;"> 
          <div class="carousel-caption kb_caption kb_caption_right">
            <!-- <h3 data-animation="animated flipInX">Dream Home</h3>  -->
          </div>
        </div>
      </div> 
      <!-- Third-Slide -->
      <div class="item">
        <div class="banner-img banner-img2" style="background: url('<?=base_url()?>assets/uploads/slide/<?=$row3['gambar_slide']?>')no-repeat center;background-size: cover;"> 
          <div class="carousel-caption kb_caption kb_caption_center">
            <!-- <h3 data-animation="animated flipInX">Latest Design</h3>  -->
          </div>
        </div>
      </div> 
    </div> 
    <!-- Left-Button -->
    <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a> 
    <!-- Right-Button -->
    <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
      <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> 
  </div>
  <script src="<?=base_url()?>template/js/custom.js"></script>
</div>