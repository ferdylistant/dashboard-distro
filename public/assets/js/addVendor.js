jQuery(document).ready(function (){
    jQuery("#addVendor").click(function () {
        jQuery.ajax({
            type: 'GET',
            url: 'https://dev.farizdotid.com/api/daerahindonesia/provinsi',
            success: function (data) {
                // console.log(data.provinsi);
                jQuery.each(data.provinsi, function (i, item) {
                    jQuery("#provinsi").append(
                        jQuery("<option></option>").val(item.id).html(item.nama)
                    );
                });
                jQuery("#exampleModalCenterTitle").html("Register Vendor");
                jQuery("#addVendorModal").modal('show');


            }
        });
        jQuery("#provinsi").change(function () {
            jQuery("#kota").empty();
            jQuery.ajax({
                type: 'GET',
                url: 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' + jQuery(this).val(),
                success: function (data) {
                    // console.log(data.kota_kabupaten);
                    jQuery.each(data.kota_kabupaten, function (i, item) {
                        jQuery("#kota").append(
                            jQuery("<option></option>").val(item.id).html(item.nama)
                        );
                    });
                }
            });
        });
    });

});
