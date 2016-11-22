
function extra(){
    $("#target").val("<form class='form-horizontal'><fieldset>\n\
\n\
\n\<!-- Form Name --><legend>Form Name</legend>\n\
\n\
<!-- Text input-->\n\
\n\
<div class='form-group'>\n\
<label class='col-md-4 control-label' for='textinput'>Text Input</label>\n\
\n\
<div class='col-md-4'>\n\
<input id='textinput' name='textinput' placeholder='placeholder' class='form-control input-md' type='text'>\n\
\n\
<span class='help-block'>help</span>\n\
\n\
</div>\n\
</div>\n\
</fieldset>\n\
</form>");
    
    alert($("#render").val())
    


}