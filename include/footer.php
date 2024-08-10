<footer class="main-footer">
 <div class="pull-right d-none d-sm-inline-block">
  <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
   <li class="nav-item">
   </li>
 </ul>
</div>
<div class="row" style="align-items: center;">
  <div class="col-md-auto col-12">
   © <?php echo date('Y') ?> All rights reserved.
 </div>
      <!--     <div class="col-md-auto col-12 copyrights-link
         ml-md-auto">
         <a href="https://www.graphixmedia.net/" title="Website Designing & Development
             in Ranchi, Ecommerce, Software
             Development,
             Graphics Design, SEO, Digital Marketing,
             Application, CMS, ERP Software, Billing
             Software in Ranchi, Jharkhand" target="_blank">Powered By - <img src="images/logo-footer1.png"></a>
           </div> -->
         </div>
       </footer>
       <aside class="control-sidebar">
         <div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger" data-toggle="control-sidebar"><i class="fa fa-close text-white"></i></span> </div>
         <!-- Create the tabs -->
         <div class="dropdown-divider my-30"></div>
         <div>
          <div class="d-flex align-items-center mb-30">
           <div class="me-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
            <!-- <span class="icon-Attachment1 fs-24"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span> -->
            <i class="fa fa-sign-out"></i>
          </div>
          <div class="d-flex flex-column fw-500">
            <a href="logout.php" class="text-dark hover-primary mb-1 fs-16">Logout</a>
          </div>
        </div>
      </div>
      <!-- Tab panes -->
    </aside>
    <script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {
      var mode =  localStorage.getItem('mode');
      if (mode === 'dark') {
       document.body.classList.remove('dark-skin');
       document.body.classList.add('light-skin');
     } else {
       document.body.classList.remove('light-skin');
       document.body.classList.add('dark-skin');
     }
   });
 </script>
 <script>
   function darktolight(abc){
    var mode =  abc;
    if (mode === 'dark') {
     document.body.classList.remove('dark-skin');
     document.body.classList.add('light-skin');
     localStorage.setItem('mode', 'light');
   } else {
     document.body.classList.remove('light-skin');
     document.body.classList.add('dark-skin');
     localStorage.setItem('mode', 'dark');
   }
 } 
</script>