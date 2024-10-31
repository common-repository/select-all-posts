
document.addEventListener("DOMContentLoaded", function() {
    var itemCount = jQuery(".displaying-num").first().text();
    var selectAllHtml = "<div id='select-everything-container' style='margin: 10px'> \
        <label >\
            <input id='cwb-select-everything-checkbox' name='cwb-apply-on-everything' type='checkbox' style='margin-right: 10px;'>Select all " + itemCount + " \
        </label> \
    </div>";
    jQuery(".check-column input[type=checkbox]").on('change', function(ev){
        var selectAllcheckbox = jQuery("#cwb-select-everything-checkbox");
        if(selectAllcheckbox.length){
            selectAllcheckbox.prop("checked", () => false);
            selectAllcheckbox.value = false;
		}

	})
	jQuery(".tablenav.top").after(selectAllHtml);
	jQuery("#cwb-select-everything-checkbox").on('change', function(e){
		if(this.checked){
			
			jQuery('.check-column input[type=checkbox]').prop('checked', function(i, v) { return true; });
		}else{
			
		}
	});


});