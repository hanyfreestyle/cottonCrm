<script>
    function check_all_in_document(doc) {
        var c = new Array();
        c = doc.getElementsByTagName('input');
        for (var i = 0; i < c.length; i++) {
            if (c[i].type == 'checkbox') {
                c[i].checked = true;
            }
        }
    }

    function check_no_in_document(doc) {
        var c = new Array();
        c = doc.getElementsByTagName('input');
        for (var i = 0; i < c.length; i++) {
            if (c[i].type == 'checkbox') {
                c[i].checked = false;
            }
        }
    }

    function Check(chk) {
        if (document.myform.Check_ctr.checked == true) {
            check_all_in_document(myform);
        } else {
            check_no_in_document(myform);
        }
    }
</script>
