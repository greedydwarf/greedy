<?php
/*
 * Shoputils
 *
 * ПРИМЕЧАНИЕ К ЛИЦЕНЗИОННОМУ СОГЛАШЕНИЮ
 *
 * Этот файл связан лицензионным соглашением, которое можно найти в архиве,
 * вместе с этим файлом. Файл лицензии называется: LICENSE.1.5.x.RUS.txt
 * Так же лицензионное соглашение можно найти по адресу:
 * http://opencart.shoputils.ru/LICENSE.1.5.x.RUS.txt
 * 
 * =================================================================
 * OPENCART 1.5.x ПРИМЕЧАНИЕ ПО ИСПОЛЬЗОВАНИЮ
 * =================================================================
 *  Этот файл предназначен для Opencart 1.5.x. Shoputils не
 *  гарантирует правильную работу этого расширения на любой другой 
 *  версии Opencart, кроме Opencart 1.5.x. 
 *  Shoputils не поддерживает программное обеспечение для других 
 *  версий Opencart.
 * =================================================================
*/
?>
<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a
            href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/shoputils_mail_status_order.png" width="22" height="22"><?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();"
                                    class="button"><span><?php echo $button_save; ?></span></a><a
                    onclick="location='<?php echo $cancel; ?>';"
                    class="button"><span><?php echo $button_cancel; ?></span></a></div>
        </div>
        <div class="content">
        <div id="tabs" class="htabs">
            <a href="#tab_new_order"><?php echo $tab_new_order; ?></a>
            <a href="#tab_order_statuses"><?php echo $tab_order_statuses; ?></a>
            <a href="#tab_settings_ft"><?php echo $tab_settings_ft; ?></a>
        </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <div id="tab_new_order">
                <table class="form">
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_new_order; ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_new_status; ?>"><?php echo $entry_status; ?></span>
                            </label>
                        </td>
                        <td><select name="shoputils_mail_order_status_new_status">
                            <?php if ((isset($shoputils_mail_order_status_new_status)) && ($shoputils_mail_order_status_new_status)) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label">
                                <span class="required">*</span><span class="control-label" title="<?php echo $help_new_subject; ?>"><?php echo $entry_subject; ?></span>
                            </label>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                    <input style="width: 100%;" type="text" id="new-subject-<?php echo $language['language_id']; ?>"
                                           name="shoputils_mail_order_status_new_subject[<?php echo $language['language_id']; ?>]"
                                           value="<?php echo !empty($shoputils_mail_order_status_new_subject[$language['language_id']])
                                                       ? $shoputils_mail_order_status_new_subject[$language['language_id']] : $new_subject_default;; ?>"/>
                                </div>
                              <?php } ?>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="required">*</span><span class="control-label" title="<?php echo $help_new_content; ?>"><?php echo $entry_content; ?></span>
                            </label>
                            <div class="help"><a class="hidelink"><?php echo $help_list_helper; ?></a></div>
                            <div class="help hide"><?php echo $list_helper_new_order; ?></div>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="NewContentDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <div class="help" style="text-align: center;"><?php echo $help_on_ckeditor; ?></div>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="10" id="new-content-<?php echo $language['language_id']; ?>" class="on-ckeditor"
                                   name="shoputils_mail_order_status_new_content[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_new_content[$language['language_id']])
                                                   ? $shoputils_mail_order_status_new_content[$language['language_id']] : $new_content_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="new-content-default"><?php echo $new_content_default; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_admin_new_order; ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_admin_new_status; ?>"><?php echo $entry_admin_status; ?></span>
                            </label>
                        </td>
                        <td><select name="shoputils_mail_order_status_admin_new_status">
                            <?php if ((isset($shoputils_mail_order_status_admin_new_status)) && ($shoputils_mail_order_status_admin_new_status)) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label">
                                <span class="required">*</span><span class="control-label" title="<?php echo $help_new_subject; ?>"><?php echo $entry_subject; ?></span>
                            </label>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                    <input style="width: 100%;" type="text" id="admin-new-subject-<?php echo $language['language_id']; ?>"
                                           name="shoputils_mail_order_status_admin_new_subject[<?php echo $language['language_id']; ?>]"
                                           value="<?php echo !empty($shoputils_mail_order_status_admin_new_subject[$language['language_id']])
                                                       ? $shoputils_mail_order_status_admin_new_subject[$language['language_id']] : $new_subject_default;; ?>"/>
                                </div>
                              <?php } ?>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="required">*</span><span class="control-label" title="<?php echo $help_new_content; ?>"><?php echo $entry_content; ?></span>
                            </label>
                            <div class="help"><a class="hidelink-admin"><?php echo $help_list_helper; ?></a></div>
                            <div class="help hide-admin"><?php echo $list_helper_new_order; ?></div>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="AdminNewContentDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <div class="help" style="text-align: center;"><?php echo $help_on_ckeditor; ?></div>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="10" id="admin-new-content-<?php echo $language['language_id']; ?>" class="on-ckeditor"
                                   name="shoputils_mail_order_status_admin_new_content[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_admin_new_content[$language['language_id']])
                                                   ? $shoputils_mail_order_status_admin_new_content[$language['language_id']] : $new_content_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="admin-new-content-default"><?php echo $new_content_default; ?></textarea>
                        </td>
                    </tr>
                </table>
            </div><!-- </div id="tab_new_order"> -->
            <div id="tab_order_statuses">
                <div class="vtabs">
                    <?php foreach ($order_statuses as $vtab) { ?>
                    <a href="#tab<?php echo $vtab['order_status_id']; ?>"><?php echo $vtab['name']; ?></a>
                    <?php } ?>
                </div>
                <?php foreach ($order_statuses as $vtab) { ?>
                    <div id="tab<?php echo $vtab['order_status_id']; ?>" class="vtabs-content">
                        <table class="form">
                            <tr>
                                <td colspan="2" style="text-align: left;">
                                    <h2><?php echo sprintf($entry_current_order_status, $vtab['name']); ?></h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <span class="control-label" title="<?php echo $help_status; ?>"><?php echo $entry_status; ?></span>
                                    </label>
                                </td>
                                <td><select name="shoputils_mail_order_status_status<?php echo $vtab['order_status_id']; ?>">
                                    <?php if ((isset($shoputils_mail_order_status_status[$vtab['order_status_id']])) && ($shoputils_mail_order_status_status[$vtab['order_status_id']])) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <span class="control-label" title="<?php echo sprintf($help_chkbox_notify, $vtab['name']); ?>"><?php echo $entry_chkbox_notify; ?></span>
                                    </label>
                                </td>
                                <td>
                                  <?php if ((isset($shoputils_mail_order_status_notify[$vtab['order_status_id']])) && ($shoputils_mail_order_status_notify[$vtab['order_status_id']])) { ?>
                                  <input type="radio" name="shoputils_mail_order_status_notify<?php echo $vtab['order_status_id']; ?>" value="1" checked="checked" />
                                  <?php echo $text_yes; ?>
                                  <input type="radio" name="shoputils_mail_order_status_notify<?php echo $vtab['order_status_id']; ?>" value="0" />
                                  <?php echo $text_no; ?>
                                  <?php } else { ?>
                                  <input type="radio" name="shoputils_mail_order_status_notify<?php echo $vtab['order_status_id']; ?>" value="1" />
                                  <?php echo $text_yes; ?>
                                  <input type="radio" name="shoputils_mail_order_status_notify<?php echo $vtab['order_status_id']; ?>" value="0" checked="checked" />
                                  <?php echo $text_no; ?>
                                  <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <span class="required">*</span><span class="control-label" title="<?php echo sprintf($help_subject, $vtab['name']); ?>"><?php echo $entry_subject; ?></span>
                                    </label>
                                </td>
                                <td>
                                  <?php foreach ($oc_languages as $language) { ?>
                                    <div class="input-group">
                                        <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                        <input style="width: 100%;" type="text" id="subject<?php echo $vtab['order_status_id']; ?>-<?php echo $language['language_id']; ?>"
                                               name="shoputils_mail_order_status_subject<?php echo $vtab['order_status_id']; ?>[<?php echo $language['language_id']; ?>]"
                                               value="<?php echo !empty($shoputils_mail_order_status_subject[$vtab['order_status_id']][$language['language_id']])
                                                           ? $shoputils_mail_order_status_subject[$vtab['order_status_id']][$language['language_id']] : ''; ?>"/>
                                    </div>
                                  <?php } ?>
                                  <?php if ($error_subject[$vtab['order_status_id']]) { ?>
                                  <span class="error"><?php echo $error_subject[$vtab['order_status_id']]; ?></span>
                                  <?php } ?>
                                </td>
                            </tr>
                            <tr style="vertical-align: top;">
                                <td>
                                    <label class="control-label">
                                        <span class="required">*</span><span class="control-label" title="<?php echo sprintf($help_content, $vtab['name']); ?>"><?php echo $entry_content; ?></span>
                                    </label>
                                    <div class="help"><a class="hidelink<?php echo $vtab['order_status_id']; ?>"><?php echo $help_list_helper; ?></a></div>
                                    <div class="help hide<?php echo $vtab['order_status_id']; ?>"><?php echo $list_helper_update_order; ?></div>
                                </td>
                                <td>
                                  <div class="help" style="text-align: center;"><?php echo $help_on_ckeditor; ?></div>
                                  <?php foreach ($oc_languages as $language) { ?>
                                    <div class="input-group">
                                        <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                        <textarea style="width: 100%;" rows="10" id="content<?php echo $vtab['order_status_id']; ?>-<?php echo $language['language_id']; ?>" class="on-ckeditor"
                                           name="shoputils_mail_order_status_content<?php echo $vtab['order_status_id']; ?>[<?php echo $language['language_id']; ?>]"
                                           ><?php echo !empty($shoputils_mail_order_status_content[$vtab['order_status_id']][$language['language_id']])
                                                       ? $shoputils_mail_order_status_content[$vtab['order_status_id']][$language['language_id']] : ''; ?></textarea>
                                    </div>
                                  <?php } ?>
                                  <?php if ($error_content[$vtab['order_status_id']]) { ?>
                                  <span class="error"><?php echo $error_content[$vtab['order_status_id']]; ?></span>
                                  <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="text-align: left;">
                                    <h2><?php echo sprintf($entry_admin_current_order_status, $vtab['name']); ?></h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <span class="control-label" title="<?php echo $help_admin_status; ?>"><?php echo $entry_admin_status; ?></span>
                                    </label>
                                </td>
                                <td><select name="shoputils_mail_order_status_admin_status<?php echo $vtab['order_status_id']; ?>">
                                    <?php if ((isset($shoputils_mail_order_status_admin_status[$vtab['order_status_id']])) && ($shoputils_mail_order_status_admin_status[$vtab['order_status_id']])) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label">
                                        <span class="required">*</span><span class="control-label" title="<?php echo sprintf($help_subject, $vtab['name']); ?>"><?php echo $entry_subject; ?></span>
                                    </label>
                                </td>
                                <td>
                                  <?php foreach ($oc_languages as $language) { ?>
                                    <div class="input-group">
                                        <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                        <input style="width: 100%;" type="text" id="admin-subject<?php echo $vtab['order_status_id']; ?>-<?php echo $language['language_id']; ?>"
                                               name="shoputils_mail_order_status_admin_subject<?php echo $vtab['order_status_id']; ?>[<?php echo $language['language_id']; ?>]"
                                               value="<?php echo !empty($shoputils_mail_order_status_admin_subject[$vtab['order_status_id']][$language['language_id']])
                                                           ? $shoputils_mail_order_status_admin_subject[$vtab['order_status_id']][$language['language_id']] : ''; ?>"/>
                                    </div>
                                  <?php } ?>
                                  <?php if ($error_admin_subject[$vtab['order_status_id']]) { ?>
                                  <span class="error"><?php echo $error_admin_subject[$vtab['order_status_id']]; ?></span>
                                  <?php } ?>
                                </td>
                            </tr>
                            <tr style="vertical-align: top;">
                                <td>
                                    <label class="control-label">
                                        <span class="required">*</span><span class="control-label" title="<?php echo sprintf($help_content, $vtab['name']); ?>"><?php echo $entry_content; ?></span>
                                    </label>
                                    <div class="help"><a class="hidelink-admin<?php echo $vtab['order_status_id']; ?>"><?php echo $help_list_helper; ?></a></div>
                                    <div class="help hide-admin<?php echo $vtab['order_status_id']; ?>"><?php echo $list_helper_update_order; ?></div>
                                </td>
                                <td>
                                  <div class="help" style="text-align: center;"><?php echo $help_on_ckeditor; ?></div>
                                  <?php foreach ($oc_languages as $language) { ?>
                                    <div class="input-group">
                                        <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                        <textarea style="width: 100%;" rows="10" id="admin-content<?php echo $vtab['order_status_id']; ?>-<?php echo $language['language_id']; ?>" class="on-ckeditor"
                                           name="shoputils_mail_order_status_admin_content<?php echo $vtab['order_status_id']; ?>[<?php echo $language['language_id']; ?>]"
                                           ><?php echo !empty($shoputils_mail_order_status_admin_content[$vtab['order_status_id']][$language['language_id']])
                                                       ? $shoputils_mail_order_status_admin_content[$vtab['order_status_id']][$language['language_id']] : ''; ?></textarea>
                                    </div>
                                  <?php } ?>
                                  <?php if ($error_admin_content[$vtab['order_status_id']]) { ?>
                                  <span class="error"><?php echo $error_admin_content[$vtab['order_status_id']]; ?></span>
                                  <?php } ?>
                                </td>
                            </tr>

                        </table>
                    </div><!-- </div id="tab<?php echo $vtab['order_status_id']; ?>"> -->
                <?php } ?>
                <div class="help" style="padding: 15px 15px;"><?php echo $text_info; ?></div>
            </div><!-- </div id="tab_order_statuses"> -->
            <div id="tab_settings_ft">
                <table class="form">
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_products_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_products_ft; ?>"><?php echo $entry_products_ft; ?></span>
                            </label>
                            <div class="help"><a class="hidelink-product"><?php echo $help_list_helper; ?></a></div>
                            <div class="help hide-product"><?php echo $products_helper; ?></div>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="ProductsDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <input style="margin-left: 10%;" type="text" value="{products_header}" disabled="disabled" /><br />
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="10" id="products-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_products_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_products_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_products_ft[$language['language_id']] : $products_ft_default; ?></textarea>
                            </div>
                            <input style="margin-left: 10%;" type="text" value="{products_footer}" disabled="disabled" /><br /><br />
                           <?php } ?>
                           <textarea style="display: none;" id="products-default"><?php echo $products_ft_default; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_products_header_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_products_header_ft; ?>"><?php echo $entry_products_header_ft; ?></span>
                            </label>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="ProductsHeaderDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="5" id="products-header-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_products_header_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_products_header_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_products_header_ft[$language['language_id']] : $products_header_ft_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="products-header-default"><?php echo $products_header_ft_default; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_products_footer_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_products_footer_ft; ?>"><?php echo $entry_products_footer_ft; ?></span>
                            </label>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="ProductsFooterDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="5" id="products-footer-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_products_footer_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_products_footer_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_products_footer_ft[$language['language_id']] : $products_footer_ft_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="products-footer-default"><?php echo $products_footer_ft_default; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_totals_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_totals_ft; ?>"><?php echo $entry_totals_ft; ?></span>
                            </label>
                            <div class="help"><a class="hidelink-total"><?php echo $help_list_helper; ?></a></div>
                            <div class="help hide-total"><?php echo $totals_helper; ?></div>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="TotalsDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <input style="margin-left: 10%;" type="text" value="{totals_header}" disabled="disabled" /><br />
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="10" id="totals-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_totals_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_totals_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_totals_ft[$language['language_id']] : $totals_ft_default; ?></textarea>
                            </div>
                            <input style="margin-left: 10%;" type="text" value="{totals_footer}" disabled="disabled" /><br /><br />
                           <?php } ?>
                           <textarea style="display: none;" id="totals-default"><?php echo $totals_ft_default; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_totals_header_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_totals_header_ft; ?>"><?php echo $entry_totals_header_ft; ?></span>
                            </label>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="TotalsHeaderDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="5" id="totals-header-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_totals_header_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_totals_header_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_totals_header_ft[$language['language_id']] : $totals_header_ft_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="totals-header-default"><?php echo $totals_header_ft_default; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_totals_footer_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_totals_footer_ft; ?>"><?php echo $entry_totals_footer_ft; ?></span>
                            </label>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="TotalsFooterDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="5" id="totals-footer-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_totals_footer_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_totals_footer_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_totals_footer_ft[$language['language_id']] : $totals_footer_ft_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="totals-footer-default"><?php echo $totals_footer_ft_default; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_product_first_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_product_first_ft; ?>"><?php echo $entry_product_first_ft; ?></span>
                            </label>
                            <div class="help"><a class="hidelink-product-first"><?php echo $help_list_helper; ?></a></div>
                            <div class="help hide-product-first"><?php echo $products_helper; ?></div>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="ProductFirstDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="5" id="product-first-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_product_first_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_product_first_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_product_first_ft[$language['language_id']] : $product_first_ft_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="product-first-default"><?php echo $product_first_ft_default; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left;">
                            <h2><?php echo $entry_product_last_ft; ?></h2>
                        </td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <td>
                            <label class="control-label">
                                <span class="control-label" title="<?php echo $help_product_last_ft; ?>"><?php echo $entry_product_last_ft; ?></span>
                            </label>
                            <div class="help"><a class="hidelink-product-last"><?php echo $help_list_helper; ?></a></div>
                            <div class="help hide-product-last"><?php echo $products_helper; ?></div>
                            <div style="margin-top: 5px;" title="<?php echo $help_button_default; ?>">
                                <a onclick="ProductLastDefault();" class="button"><span><?php echo $button_default; ?></span></a>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($oc_languages as $language) { ?>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                                <textarea style="width: 100%;" rows="5" id="product-last-<?php echo $language['language_id']; ?>"
                                   name="shoputils_mail_order_status_product_last_ft[<?php echo $language['language_id']; ?>]"
                                   ><?php echo !empty($shoputils_mail_order_status_product_last_ft[$language['language_id']])
                                                   ? $shoputils_mail_order_status_product_last_ft[$language['language_id']] : $product_last_ft_default; ?></textarea>
                            </div>
                           <?php } ?>
                           <textarea style="display: none;" id="product-last-default"><?php echo $product_last_ft_default; ?></textarea>
                        </td>
                    </tr>


                </table>
            </div><!-- </div id="tab_settings_ft"> -->
           </form>
        </div><!-- </div class="box">  -->
        <div style="padding: 15px 15px; border:1px solid #ccc; margin-top: 15px; box-shadow:0 0px 5px rgba(0,0,0,0.1);"><?php echo $text_copyright; ?></div>
    </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
    $('.on-ckeditor').bind('dblclick', function() {
        console.log(this);
        CKEDITOR.replace(this, {
            //toolbar: 'full',
            resize_enabled: true, width: '100%', height: '300px', autoParagraph: false, toolbarStartupExpanded: true,
            filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
        });
    });

  $('#tabs a').tabs();
  $('.vtabs a').tabs(); 

  function NewContentDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#new-content-default').val();
      console.log(value);
      <?php foreach ($oc_languages as $language) { ?>
        CKEDITOR.instances['new-content-<?php echo $language['language_id']; ?>'].setData(value);
      <?php } ?>
    }
  }

  function AdminNewContentDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#admin-new-content-default').val();
      console.log(value);
      <?php foreach ($oc_languages as $language) { ?>
        CKEDITOR.instances['admin-new-content-<?php echo $language['language_id']; ?>'].setData(value);
      <?php } ?>
    }
  }

  function ProductsDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#products-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#products-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }

  function ProductsHeaderDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#products-header-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#products-header-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }

  function ProductsFooterDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#products-footer-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#products-footer-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }

  function TotalsDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#totals-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#totals-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }

  function TotalsHeaderDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#totals-header-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#totals-header-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }

  function TotalsFooterDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#totals-footer-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#totals-footer-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }

  function ProductFirstDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#product-first-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#product-first-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }

  function ProductLastDefault() {
    if (confirm('<?php echo $text_confirm; ?>')){
      var value = $('#product-last-default').val();
      <?php foreach ($oc_languages as $language) { ?>
        $('#product-last-<?php echo $language['language_id']; ?>').val(value);
      <?php } ?>
    }
  }


  $(document).ready(function(){
    $(".hide").hide();
    $(".hide-admin").hide();
    $(".hide-product").hide();
    $(".hide-total").hide();
    $(".hide-product-first").hide();
    $(".hide-product-last").hide();
    <?php foreach ($order_statuses as $vtab) { ?>
      $(".hide<?php echo $vtab['order_status_id']; ?>").hide();
      $(".hide-admin<?php echo $vtab['order_status_id']; ?>").hide();
    <?php } ?>
    $(".list tr:odd").css("background-color", "#FFFFFF");
  });

  $("a.hidelink").click(function () {
      $(".hide").toggle("slow");
  });
  $("a.hidelink-admin").click(function () {
      $(".hide-admin").toggle("slow");
  });
  $("a.hidelink-product").click(function () {
      $(".hide-product").toggle("slow");
  });
  $("a.hidelink-total").click(function () {
      $(".hide-total").toggle("slow");
  });
  $("a.hidelink-product-first").click(function () {
      $(".hide-product-first").toggle("slow");
  });
  $("a.hidelink-product-last").click(function () {
      $(".hide-product-last").toggle("slow");
  });
  <?php foreach ($order_statuses as $vtab) { ?>
    $("a.hidelink<?php echo $vtab['order_status_id']; ?>").click(function () {
        $(".hide<?php echo $vtab['order_status_id']; ?>").toggle("slow");
    });
    $("a.hidelink-admin<?php echo $vtab['order_status_id']; ?>").click(function () {
        $(".hide-admin<?php echo $vtab['order_status_id']; ?>").toggle("slow");
    });
  <?php } ?>
//--></script>
<?php echo $footer; ?>