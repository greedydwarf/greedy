<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
	  
        <button type="submit" form="form-advancedlogin" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title2; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-advancedlogin" class="form-horizontal">
		
	
	<?php if (isset($validation)) { ?>
			 <div class="tab-content">		  
		  <div class="tab-pane active" id="tab-general">
              <div class="table-responsive">
		 <table class="table table-bordered table-hover">
            <tr>
                <td colspan="2">
                    <span style='text-align: center;'><b><?php echo $text_licence_info; ?></b></span>
                </td>
            </tr>
            <tr>
                <td><?php echo $entry_transaction_email; ?></td>
                <td><input type="text" name="email" value="" /></td>
            </tr>
			 <tr>
                <td></td>
                <td><input type="hidden" name="advancedlogin_transaction_id" value="0000" /></td>
            </tr>
         
        </table>
		</div></div></div>
		
		 <?php } else { ?>
		 
          <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-modulesetting" data-toggle="tab"><?php echo $tab_modulesetting; ?></a></li>
            <li><a href="#tab-general" data-toggle="tab"><?php echo $tab_popup; ?></a></li>
			<li><a href="#fb" data-toggle="tab"><?php echo $tab_fb; ?></a></li>
           <li><a href="#local" data-toggle="tab"><?php echo $tab_local; ?></a></li>
           <li><a href="#google" data-toggle="tab"><?php echo $tab_google; ?></a></li>
           <li><a href="#autocoupon" data-toggle="tab"><?php echo $tab_autocoupon; ?></a></li>
           <li><a href="#tab-mail" data-toggle="tab"><?php echo $tab_email; ?></a></li>
            <li><a href="#tab-support" data-toggle="tab"><?php echo $tab_support; ?></a></li>
          </ul>
          <div class="tab-content">
          <div class="tab-pane active" id="tab-modulesetting">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $column_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="modulearray[name]" placeholder="<?php echo $column_name ;?>" value="<?php echo $modulearray['name'];?>" class="form-control">
               <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-type"><?php echo $entry_type; ?></label>
            <div class="col-sm-10">
              <select name="modulearray[type]" class="form-control">
                <?php if ($modulearray['type'] == 'thickbox') { ?>
                <option value="thickbox" selected="selected">thickbox</option>
                <?php } else { ?>
                <option value="thickbox">thickbox</option>
                <?php } ?>
			
                <?php if ($modulearray['type'] == 'popup') { ?>
                <option value="popup" selected="selected">popup</option>
                <?php } else { ?>
                <option value="popup">popup</option>
                <?php } ?>
				<?php if ($modulearray['type'] == 'header') { ?>
                <option value="header" selected="selected">header</option>
                <?php } else { ?>
                <option value="header">header</option>
                <?php } ?>
                <?php if ($modulearray['type'] == 'normal') { ?>
                <option value="normal" selected="selected">normal</option>
                <?php } else { ?>
                <option value="normal">normal</option>
                <?php } ?>
                <?php if ($modulearray['type'] == 'footer') { ?>
                <option value="footer" selected="selected">footer</option>
                <?php } else { ?>
                <option value="footer">footer</option>
                <?php } ?>

      
<?php if ($modulearray['type'] == 'slideright') { ?>
                <option value="slideright" selected="selected">slideright</option>
                <?php } else { ?>
                <option value="slideright">slideright</option>
                <?php } ?>

<?php if ($modulearray['type'] == 'slideleft') { ?>
                <option value="slideleft" selected="selected">slideleft</option>
                <?php } else { ?>
                <option value="slideleft">slideleft</option>
                <?php } ?>

              </select>
            </div>
          </div> 
           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="modulearray[status]" id="input-status" class="form-control">
                <?php if ($modulearray['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div> 
          
          </div>
		  
		  <div class="tab-pane" id="tab-general">
		   <ul class="nav nav-tabs" id="popup">
				<li><a href="#vtab-1-1" data-toggle="tab"><?php echo $tab_popup; ?></a></li>
				
                <?php foreach ($languages as $language) { ?>
                <li><a href="#languagem<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
				
				<li><a href="#vtab-1-3" data-toggle="tab"><?php echo $tab_fields; ?></a></li>
              </ul>
		  
		            <div class="tab-content">
					
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="languagem<?php echo $language['language_id']; ?>">
		         <div class="table-responsive">
                <table  class="table table-bordered table-hover">
                <tr>
          <td class="text-left"><?php echo $entry_popupheaderimage; ?> </td>
		 <td class="text-left"><a href="" id="thumb-image<?php echo $language['language_id']; ?>hi" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb2[$language['language_id']]; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="advancedlogin_<?php echo $language['language_id']; ?>_headerimage" value="<?php echo $advancedlogin[$language['language_id']]['headerimage']; ?>" id="image<?php echo $language['language_id']; ?>" />
                  </td>
            </tr>
			
			
			 <tr>
		 <td class="text-left"><?php echo $entry_thickboxbutton; ?> </td>
  <td class="text-left"><a href="" id="thumb-image<?php echo $language['language_id']; ?>3" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb3[$language['language_id']]; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="advancedlogin_<?php echo $language['language_id']; ?>_thickboxbutton" value="<?php echo $advancedlogin[$language['language_id']]['thickboxbutton']; ?>" id="image<?php echo $language['language_id']; ?>3" /></td>
				  </tr>
				  
				  				  
				  			 <tr>
		 <td class="text-left"><?php echo $entry_gbutton; ?> </td>
 <td class="text-left"><a href="" id="thumb-image<?php echo $language['language_id']; ?>4" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb4[$language['language_id']]; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="advancedlogin_<?php echo $language['language_id']; ?>_gbutton" value="<?php echo $advancedlogin[$language['language_id']]['gbutton']; ?>" id="image<?php echo $language['language_id']; ?>4" />
                  </td>
				  </tr>
				  
				  				  
				  			 <tr>
		 <td class="text-left"><?php echo $entry_fbutton; ?> </td>
 <td class="text-left"><a href="" id="thumb-image<?php echo $language['language_id']; ?>fb" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb5[$language['language_id']]; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="advancedlogin_<?php echo $language['language_id']; ?>_fbutton" value="<?php echo $advancedlogin[$language['language_id']]['fbutton']; ?>" id="image<?php echo $language['language_id']; ?>5" />
                </td>
				  </tr>
			
				<tr>
          <td class="text-left"> <?php echo $entry_fieldpopup; ?></td>
          <td class="text-left">
<textarea name="advancedlogin_fieldpopup_<?php echo $language['language_id']; ?>" id="advancedlogin_fieldpopup_<?php echo $language['language_id']; ?>" cols="200" rows="2"><?php echo isset(${'advancedlogin_fieldpopup_' . $language['language_id']}) ? ${'advancedlogin_fieldpopup_' . $language['language_id']} : ''; ?></textarea>

          </td>
	</tr>
            
			
			
 <tr>
          <td class="text-left"> <?php echo $entry_fbmessgetop; ?></td>
          <td class="text-left">
  <textarea name="advancedlogin_fbmessgetop_<?php echo $language['language_id']; ?>" cols="200" rows="2"><?php echo isset(${'advancedlogin_fbmessgetop_' . $language['language_id']}) ? ${'advancedlogin_fbmessgetop_' . $language['language_id']} : ''; ?></textarea>
         </td>
	</tr>

<tr>
          <td class="text-left"> <?php echo $entry_fbmessgebottom; ?></td>
          <td class="text-left">
       
<textarea name="advancedlogin_fbmessgebottom_<?php echo $language['language_id']; ?>" cols="200" rows="2"><?php echo isset(${'advancedlogin_fbmessgebottom_' . $language['language_id']}) ? ${'advancedlogin_fbmessgebottom_' . $language['language_id']} : ''; ?></textarea>
          </td>
	</tr>
	
<tr>
          <td class="text-left"> <?php echo $entry_fbheading; ?></td>
          <td class="text-left">
          <input type="text" name="advancedlogin_fbheading_<?php echo $language['language_id']; ?>" id="advancedlogin_fbheading_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_fbheading_' . $language['language_id']}; ?>" />
           </td>
	</tr>
	
		
					  
				  			
	    	<tr>
	<td class="text-left"><?php echo $entry_logheading; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_logheading_<?php echo $language['language_id']; ?>" id="advancedlogin_logheading_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_logheading_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
    
	<tr>
          <td class="text-left"> <?php echo $entry_logmessgebottom; ?></td>
          <td class="text-left">
<textarea name="advancedlogin_logmessgebottom_<?php echo $language['language_id']; ?>" cols="200" rows="2"><?php echo isset(${'advancedlogin_logmessgebottom_' . $language['language_id']}) ? ${'advancedlogin_logmessgebottom_' . $language['language_id']} : ''; ?></textarea>

          </td>
	</tr>
	
	<tr>
          <td class="text-left"> <?php echo $entry_logmessgetop; ?></td>
          <td class="text-left">
       
<textarea name="advancedlogin_logmessgetop_<?php echo $language['language_id']; ?>" cols="200" rows="2"><?php echo isset(${'advancedlogin_logmessgetop_' . $language['language_id']}) ? ${'advancedlogin_logmessgetop_' . $language['language_id']} : ''; ?></textarea>
          </td>
	</tr>
	
	
	
		    	<tr>
	<td class="text-left"><?php echo $entry_emailaddress; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_emailaddress_<?php echo $language['language_id']; ?>" id="advancedlogin_emailaddress_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_emailaddress_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
		    	<tr>
	<td class="text-left"><?php echo $entry_password; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_password_<?php echo $language['language_id']; ?>" id="advancedlogin_password_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_password_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
		    	<tr>
	<td class="text-left"><?php echo $entry_login; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_login_<?php echo $language['language_id']; ?>" id="advancedlogin_login_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_login_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
		    	<tr>
	<td class="text-left"><?php echo $entry_register; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_register_<?php echo $language['language_id']; ?>" id="advancedlogin_register_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_register_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
		    	<tr>
	<td class="text-left"><?php echo $entry_logout; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_logout_<?php echo $language['language_id']; ?>" id="advancedlogin_logout_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_logout_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
		    	<tr>
	<td class="text-left"><?php echo $entry_forgotten; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_forgotten_<?php echo $language['language_id']; ?>" id="advancedlogin_forgotten_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_forgotten_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>

			    	<tr>
	<td class="text-left"><?php echo $entry_slidelabel; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_slidelabel_<?php echo $language['language_id']; ?>" id="advancedlogin_slidelabel_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_slidelabel_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
	
	
	<tr>
	<td class="text-left"><?php echo $entry_success_login; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_successlogin_<?php echo $language['language_id']; ?>" id="advancedlogin_successlogin_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_successlogin_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
	<tr>
	<td class="text-left"><?php echo $entry_success_register; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_successregister_<?php echo $language['language_id']; ?>" id="advancedlogin_successregister_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_successregister_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
				    	<tr>
	<td class="text-left"><?php echo $entry_wrong_match; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_worngmatch_<?php echo $language['language_id']; ?>" id="advancedlogin_worngmatch_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_worngmatch_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
				    	<tr>
	<td class="text-left"><?php echo $entry_already_exist; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_alreadyexist_<?php echo $language['language_id']; ?>" id="advancedlogin_alreadyexist_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_alreadyexist_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
				    	<tr>
	<td class="text-left"><?php echo $entry_invalid_email; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_enteremail_<?php echo $language['language_id']; ?>" id="advancedlogin_enteremail_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_enteremail_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>
	
				    	<tr>
	<td class="text-left"><?php echo $entry_invalid_password; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_enterpassword_<?php echo $language['language_id']; ?>" id="advancedlogin_enterpassword_<?php echo $language['language_id']; ?>" size="50" value="<?php echo ${'advancedlogin_enterpassword_' . $language['language_id']}; ?>" />
	    	
     	  </td>
	</tr>

                </table>
              </div>
              </div>
			   <?php } ?>
			   
			   <div class="tab-pane " id="vtab-1-1">
		         <div class="table-responsive">
                <table  class="table table-bordered table-hover">
                <input type="hidden" id="advancedlogin_transaction_id" name="advancedlogin_transaction_id" value="<?php echo $advancedlogin_transaction_id; ?>">
				
                <tr>
          <td class="text-left"><?php echo $entry_enableemail; ?> </td>

  <td class="text-left"><select name="advancedlogin_enableemail" id="welcome">
              <?php if ($advancedlogin_enableemail) { ?>
              <option value="1" selected="selected"><?php echo $entry_yes?>
              <option value="0"><?php echo $entry_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_yes?></option>
              <option value="0" selected="selected"><?php echo $entry_no?></option>
              <?php } ?>
            </select> </td>
            </tr>
            
            <tr id="autocouponen">
          <td class="text-left"><?php echo $entry_autocoupon; ?> </td>

                   <td class="text-left"><select name="advancedlogin_autocoupon">
              <?php if ($advancedlogin_autocoupon) { ?>
              <option value="1" selected="selected"><?php echo $entry_yes?>
              <option value="0"><?php echo $entry_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_yes?></option>
              <option value="0" selected="selected"><?php echo $entry_no?></option>
              <?php } ?>
            </select> </td>
 </tr> 
        
        <tr>
          <td class="text-left"><?php echo $entry_popupdelay; ?> </td>
 <td class="text-left"><input type="text" name="advancedlogin_popupdelay" style="width:30px" value="<?php echo $advancedlogin_popupdelay; ?>" /></td>
            </tr>


<tr>
              <td class="text-left"><?php echo $entry_force; ?></td>
          <td class="text-left"><select name="advancedlogin_force" id="force">
              <?php if ($advancedlogin_force) { ?>
              <option value="1" selected="selected"><?php echo $entry_yes?>
              <option value="0"><?php echo $entry_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_yes?></option>
              <option value="0" selected="selected"><?php echo $entry_no?></option>
              <?php } ?>
            </select> </td>
 </tr> 
 
 <tr id="showonce">
              <td class="text-left"><?php echo $entry_showonce; ?></td>
          <td class="text-left"><select name="advancedlogin_showonce">
              <?php if ($advancedlogin_showonce) { ?>
              <option value="1" selected="selected"><?php echo $entry_once; ?>
              <option value="0"><?php echo $entry_always; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_once; ?></option>
              <option value="0" selected="selected"><?php echo $entry_always; ?></option>
              <?php } ?>
            </select> 
			
			
			
			</td>
 </tr> 
   <script>
 $(function() {
    var $typeSelector2 = $('#welcome');
    var $toggleArea2 = $('#autocouponen');
	 if ($typeSelector2.val() === '1') {
            $toggleArea2.show(); 
        }
        else {
            $toggleArea2.hide(); 
        }
    $typeSelector2.change(function(){
        if ($typeSelector2.val() === '1') {
            $toggleArea2.show(400); 
        }
        else {
            $toggleArea2.hide(400); 
        }
    });
});
 </script> 
  <script>
 $(function() {
    var $typeSelector2 = $('#force');
    var $toggleArea2 = $('#showonce');
	 if ($typeSelector2.val() === '0') {
            $toggleArea2.show(); 
        }
        else {
            $toggleArea2.hide(); 
        }
    $typeSelector2.change(function(){
        if ($typeSelector2.val() === '0') {
            $toggleArea2.show(400); 
        }
        else {
            $toggleArea2.hide(400); 
        }
    });
});
 </script>  
 
 <tr>
              <td class="text-left"><?php echo $entry_redirect_advurl; ?></td>
          <td class="text-left"><select name="advancedlogin_redirect_advurl">
              <?php if ($advancedlogin_redirect_advurl) { ?>
              <option value="1" selected="selected"><?php echo $entry_yes?>
              <option value="0"><?php echo $entry_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_yes?></option>
              <option value="0" selected="selected"><?php echo $entry_no?></option>
              <?php } ?>
            </select> </td>
 </tr> 
 
 			<tr> <td class="text-left"><?php echo $entry_customcss; ?></td>
		
			<td class="text-left"><textarea cols="50" rows="3" style="height:100px;width:250px;" placeholder="<?php echo $dpastecustom; ?>" name="advancedlogin_customcss"><?php echo isset($advancedlogin_customcss) ? $advancedlogin_customcss : ''; ?></textarea>			
			</td>
		</tr>
			

                </table>
              </div>
              </div>
			  
			  
			     <div class="tab-pane" id="vtab-1-3">
		         <div class="table-responsive">
                <table  class="table table-bordered table-hover">
                 <tr>
          <td class="text-left"><?php echo $entry_field_enable; ?> </td>
		        <td class="text-left">
			<select class="yes_no" name="advancedlogin_customer_require_enable">
              <?php if ($advancedlogin_customer_require_enable) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select></td>   
       </tr>
			
			
      <tr>
          <td class="text-left"><?php echo $entry_customer_group; ?> </td>
		        <td class="text-left">
			<select name="advancedlogin_customer_group">
           <?php foreach($customer_groups as $customer_group){ ?>
                <option value="<?php echo $customer_group['customer_group_id']; ?>" <?php if ($customer_group['customer_group_id']==$advancedlogin_customer_group) { ?> selected="selected" <?php }; ?> ><?php echo $customer_group['name']; ?>
				
				</option>
           <?php }?>
		     </select></td>   
       </tr>
	   
	   
	   
    <tr>
    	
          <td class="text-left"><?php echo $entry_customer_required; ?> </td>
		        <td class="text-left">
				

			

			<?php echo $entry_address; ?>
 <select class="yes_no" name="advancedlogin_address">
              <?php if ($advancedlogin_address) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
			</br>
			<?php echo $entry_telephone; ?>
 <select class="yes_no" name="advancedlogin_telephone">
              <?php if ($advancedlogin_telephone) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
			</br>
			<?php echo $entry_fax; ?>
 <select class="yes_no" name="advancedlogin_fax">
              <?php if ($advancedlogin_fax) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
			</br>
			
						<?php echo $entry_company; ?>
 <select class="yes_no" name="advancedlogin_company">
              <?php if ($advancedlogin_company) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
			</br>


									<?php echo $entry_city; ?>
 <select class="yes_no" name="advancedlogin_city">
              <?php if ($advancedlogin_city) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
			</br>
									<?php echo $entry_postcode; ?>
 <select class="yes_no" name="advancedlogin_postcode">
              <?php if ($advancedlogin_postcode) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
			</br>
									<?php echo $entry_country; ?>
 <select class="yes_no" name="advancedlogin_country">
              <?php if ($advancedlogin_country) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
						</br>
									<?php echo $entry_zone; ?>
 <select class="yes_no" name="advancedlogin_zone">
              <?php if ($advancedlogin_zone) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select>
			

			
 </td> </tr>

                </table>
              </div>
              </div>
			   
			  
              </div>
			  
			  
			  
			  
            </div>  
		  
		  
		  
		    <div class="tab-pane" id="fb">            
              
              <div class="tab-content">
              
					<div class="table-responsive">
           <table id="mailtab" class="table table-bordered table-hover">
 <tr>
              <td class="text-left"><?php echo $entry_enablefb; ?></td>
          <td class="text-left"><select name="advancedlogin_enablefb">
              <?php if ($advancedlogin_enablefb) { ?>
              <option value="1" selected="selected"><?php echo $entry_yes?>
              <option value="0"><?php echo $entry_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_yes?></option>
              <option value="0" selected="selected"><?php echo $entry_no?></option>
              <?php } ?>
            </select> </td>
 </tr>





	<tr>
          <td class="text-left"><?php echo $entry_apikey; ?></td>
          <td class="text-left"><input type="text" name="advancedlogin_apikey" id="advancedlogin_apikey" size="50" value="<?php echo $advancedlogin_apikey; ?>" /> </td>
	</tr>

      	<tr>
          <td class="text-left"><?php echo $entry_apisecret; ?></td>
          <td class="text-left"><input type="text" name="advancedlogin_apisecret" id="advancedlogin_apisecret" size="50" value="<?php echo $advancedlogin_apisecret; ?>" /> </td>
	</tr>
	
      	<tr>
          <td class="text-left"><?php echo $entry_pwdsecret; ?></td>
          <td class="text-left"><input type="text" name="advancedlogin_pwdsecret" id="advancedlogin_pwdsecret" size="10" value="<?php echo $advancedlogin_pwdsecret; ?>" /><br>
		<span class="help"><?php echo $entry_pwdsecret_desc; ?></span>
	</td>
	</tr>
				
				
			</table>
	</div>
		
				 
              </div>
            </div>
		  
		  
		   <div class="tab-pane" id="google">            
              
              <div class="tab-content">
              
				<div class="table-responsive">
           <table id="mailtab" class="table table-bordered table-hover">
<tr>
              <td class="text-left"><?php echo $entry_enablegoogle; ?></td>
          <td class="text-left"><select name="advancedlogin_enablegoogle">
              <?php if ($advancedlogin_enablegoogle) { ?>
              <option value="1" selected="selected"><?php echo $entry_yes?>
              <option value="0"><?php echo $entry_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_yes?></option>
              <option value="0" selected="selected"><?php echo $entry_no?></option>
              <?php } ?>
            </select> </td>
 </tr>

<tr>
    <td class="text-left"><?php echo $entry_gredirect; ?></td>
    <td class="text-left">
    	<strong><?php echo $entry_gcallback; ?></strong>
   </td>
  </tr>
  <tr>
    <td class="text-left"><?php echo $entry_gclientid; ?></td>
    <td class="text-left">
    	<input type="text" name="advancedlogin_gclientid" id="advancedlogin_gclientid" size="50" value="<?php echo $advancedlogin_gclientid; ?>" /> 

		</td>
  </tr>
  <tr>
    <td class="text-left"><?php echo $entry_gapi; ?></td>
    <td class="text-left">
    	<input type="text" name="advancedlogin_gapi" id="advancedlogin_gapi" size="50" value="<?php echo $advancedlogin_gapi; ?>" /> 
   </td>
  </tr>
    <tr>
    <td class="text-left"><?php echo $entry_gencryp; ?></td>
    <td class="text-left">
    	<input type="text" name="advancedlogin_gpwdsecret" id="advancedlogin_gpwdsecret" size="10" value="<?php echo $advancedlogin_gpwdsecret; ?>" />

		<br>   <span class="help"><?php echo $entry_pwdsecret_desc; ?></span> </td>
  </tr>
				
				
			</table>
	</div>
		
				 
              </div>
            </div>
		  
		  
		  
		  	<div class="tab-pane" id="local">            
              
              <div class="tab-content">
              
				<div class="table-responsive">
           <table id="mailtab" class="table table-bordered table-hover">
<tr>
              <td class="text-left"><?php echo $entry_enablelocal; ?></td>
          <td class="text-left"><select name="advancedlogin_enablelocal">
              <?php if ($advancedlogin_enablelocal) { ?>
              <option value="1" selected="selected"><?php echo $entry_yes?>
              <option value="0"><?php echo $entry_no?></option>
              <?php } else { ?>
              <option value="1"><?php echo $entry_yes?></option>
              <option value="0" selected="selected"><?php echo $entry_no?></option>
              <?php } ?>
            </select> </td>
 </tr>
				
				
			</table>
		</div>
		
				 
              </div>
            </div>
			
			  
		  <div class="tab-pane" id="autocoupon">            
              
              <div class="tab-content">
              
						<div class="table-responsive">
           <table id="mailtab" class="table table-bordered table-hover">
<tr>
	<td class="text-left"><?php echo $entry_coupon_name; ?></td>
	  <td class="text-left"><input type="text" name="advancedlogin_coupon_name" id="advancedlogin_coupon_name" size="50" value="<?php echo $advancedlogin_coupon_name; ?>" />
      </td></tr>
   
               <tr>
	<td class="text-left"><?php echo $entry_coupon_prefix; ?></td>
 <td class="text-left"><input type="text" name="advancedlogin_coupon_prefix" id="advancedlogin_coupon_prefix" style="width:100px" value="<?php echo $advancedlogin_coupon_prefix; ?>" />
      </td></tr>
      
       <tr>
              <td class="text-left"><?php echo $entry_coupon_type; ?></td>
          <td class="text-left"><select name="advancedlogin_coupon_type">
              <?php if ($advancedlogin_coupon_type) { ?>
              <option value="1" selected="selected"><?php echo $text_percentage; ?>
              <option value="0"><?php echo $text_fixedamount; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_percentage?></option>
              <option value="0" selected="selected"><?php echo $text_fixedamount; ?></option>
              <?php } ?>
            </select> </td>
 </tr> 
      
       <tr>
	<td class="text-left"><?php echo $entry_coupon_discount; ?></td>
 <td class="text-left"><input type="text" name="advancedlogin_coupon_discount" id="advancedlogin_coupon_discount" style="width:30px" value="<?php echo $advancedlogin_coupon_discount; ?>" />
      </td></tr>
      
          <tr>
	<td class="text-left"><?php echo $entry_coupon_total; ?></td>
 <td class="text-left"><input type="text" name="advancedlogin_coupon_total" id="advancedlogin_coupon_total" style="width:30px" value="<?php echo $advancedlogin_coupon_total; ?>" />
      </td></tr>
      
      <tr>
	<td class="text-left"> <?php echo $entry_coupon_login; ?></td>
<td class="text-left"> <select class="yes_no" name="advancedlogin_coupon_login">
              <?php if ($advancedlogin_coupon_login) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select></td></tr>
            
                  <tr>
	<td class="text-left"> <?php echo $entry__coupon_shipping; ?></td>
<td class="text-left"> <select class="yes_no" name="advancedlogin_coupon_shipping">
              <?php if ($advancedlogin_coupon_login) { ?>
              <option value="1" selected="selected"><?php echo $text_yes; ?></option>
              <option value="0"><?php echo $text_no; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_yes; ?></option>
              <option value="0" selected="selected"><?php echo $text_no; ?></option>

              <?php } ?>
            </select></td></tr>
      
    <tr>
	<td class="text-left"><?php echo $entry_coupon_weeks; ?></td>
 <td class="text-left"><input type="text" name="advancedlogin_coupon_weeks" id="advancedlogin_coupon_weeks" style="width:30px" value="<?php echo $advancedlogin_coupon_weeks; ?>" />
      </td></tr>
      
          <tr>
	<td class="text-left"><?php echo $entry_coupon_uses; ?></td>
 <td class="text-left"><input type="text" name="advancedlogin_coupon_uses" id="advancedlogin_coupon_uses" style="width:30px" value="<?php echo $advancedlogin_coupon_uses; ?>" />
      </td></tr>
				
				
			</table>
		</div>
		
				 
              </div>
            </div>
		  
		  
		  
		  
		  <div class="tab-pane" id="tab-mail">            
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
				
				
				 <div class="table-responsive">
                <table id="mailtab" class="table table-bordered table-hover">
<tr>
          <td class="text-left"> <?php echo $entry_email_subject; ?></td>
          <td class="text-left">
  <textarea name="advancedlogin_emailsubject_<?php echo $language['language_id']; ?>" cols="200" rows="2"><?php echo isset(${'advancedlogin_emailsubject_' . $language['language_id']}) ? ${'advancedlogin_emailsubject_' . $language['language_id']} : ''; ?></textarea>
         </td>
	</tr>

         <tr>
          <td class="text-left"> <?php echo $entry_email_body; ?></td>
          <td class="text-left">
  <textarea name="advancedlogin_emailbody_<?php echo $language['language_id']; ?>" id="advancedlogin_emailbody_<?php echo $language['language_id']; ?>" cols="200" rows="2"> <?php echo isset(${'advancedlogin_emailbody_' . $language['language_id']}) ? ${'advancedlogin_emailbody_' . $language['language_id']} : ''; ?></textarea>
         </td>
	</tr>
    
     <tr>
          <td class="text-left"> <?php echo $entry_autoemail_subject; ?></td>
          <td class="text-left">
  <textarea name="advancedlogin_autoemailsubject_<?php echo $language['language_id']; ?>" cols="200" rows="2"> <?php echo isset(${'advancedlogin_autoemailsubject_' . $language['language_id']}) ? ${'advancedlogin_autoemailsubject_' . $language['language_id']} : ''; ?></textarea>
         </td>
	</tr>
    
             <tr>
          <td class="text-left"> <?php echo $entry_autoemail_body; ?></td>
          <td class="text-left">
		  
		  <textarea name="advancedlogin_autoemailbody_<?php echo $language['language_id']; ?>" id="advancedlogin_autoemailbody_<?php echo $language['language_id']; ?>" cols="200" rows="2"><?php echo isset(${'advancedlogin_autoemailbody_' . $language['language_id']}) ? ${'advancedlogin_autoemailbody_' . $language['language_id']} : ''; ?></textarea>
	
	</tr>
	</table>
	</div>
		
				  
			
				  
                </div>
                <?php } ?>
              </div>
            </div>
            
            
			  <div class="tab-pane" id="tab-support">
              <div class="table-responsive">
                <table id="suporttab" class="table table-bordered table-hover">
                 
               <iframe src="http://cambrianinfosystems.com/ocadds/add1.html" width="350" height="350"></iframe>
			 
			
			<?php echo $text_info; ?>
                  
                </table>
              </div>
            </div>
			
			
			
			
			
			
                    
          
            
            
            
            
          
          </div>
		  <?php } ?>
		
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#advancedlogin_emailbody_<?php echo $language['language_id']; ?>').summernote({height: 300});
$('#advancedlogin_fieldpopup_<?php echo $language['language_id']; ?>').summernote({height: 300});
$('#advancedlogin_autoemailbody_<?php echo $language['language_id']; ?>').summernote({height: 300});

<?php } ?>
//--></script> 
   
 
  

  <script type="text/javascript"><!--
$('.date').datetimepicker({
                pickTime: false
});

$('.time').datetimepicker({
                pickDate: false
});

$('.datetime').datetimepicker({
                pickDate: true,
                pickTime: true
});
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
$('#languagem a:first').tab('show');
$('#popup a:first').tab('show');

//--></script></div>
<style>
td span:after {
    color: #1e91cf;
   content: "\f059";
    font-family: FontAwesome;
    margin-left: 4px;
}
</style>
<?php echo $footer; ?>