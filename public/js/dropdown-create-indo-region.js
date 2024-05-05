$(document).ready(function () {
    // Make ajax request to get regencies based on selected province
    $('select[name="province_id"]').on("change", function () {
        $('select[name="regency_id"]').prop("disabled", true);
        $('select[name="district_id"]').prop("disabled", true);
        $('select[name="village_id"]').prop("disabled", true);

        $('select[name="regency_id"]').html(
            '<option selected value="">Pilih Kabupaten/Kota</option>'
        );
        $('select[name="district_id"]').html(
            '<option selected value="">Pilih Kecamatan</option>'
        );
        $('select[name="village_id"]').html(
            '<option selected value="">Pilih Desa/Kelurahan</option>'
        );

        let province_id = $(this).val();
        if (province_id) {
            $.ajax({
                url: "/getRegencies/" + province_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="regency_id"]').empty();
                    $('select[name="regency_id"]').append(
                        '<option selected value="">Pilih Kabupaten/Kota</option>'
                    );
                    $.each(data, function (key, value) {
                        $('select[name="regency_id"]').append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                    $('select[name="regency_id"]').prop("disabled", false);
                },
            });
        }
    });

    // Make ajax request to get districts based on selected regency
    $('select[name="regency_id"]').on("change", function () {
        $('select[name="district_id"]').prop("disabled", true);
        $('select[name="village_id"]').prop("disabled", true);

        $('select[name="district_id"]').html(
            '<option selected value="">Pilih Kecamatan</option>'
        );
        $('select[name="village_id"]').html(
            '<option selected value="">Pilih Desa/Kelurahan</option>'
        );

        let regency_id = $(this).val();
        if (regency_id) {
            $.ajax({
                url: "/getDistricts/" + regency_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="district_id"]').empty();
                    $('select[name="district_id"]').append(
                        '<option selected value="">Pilih Kecamatan</option>'
                    );
                    $.each(data, function (key, value) {
                        $('select[name="district_id"]').append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                    $('select[name="district_id"]').prop("disabled", false);
                },
            });
        }
    });

    // Make ajax request to get villages based on selected district
    $('select[name="district_id"]').on("change", function () {
        $('select[name="village_id"]').prop("disabled", true);
        $('select[name="village_id"]').html(
            '<option selected value="">Pilih Desa/Kelurahan</option>'
        );

        let district_id = $(this).val();
        if (district_id) {
            $.ajax({
                url: "/getVillages/" + district_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="village_id"]').empty();
                    $('select[name="village_id"]').append(
                        '<option selected value="">Pilih Desa/Kelurahan</option>'
                    );
                    $.each(data, function (key, value) {
                        $('select[name="village_id"]').append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                    $('select[name="village_id"]').prop("disabled", false);
                },
            });
        }
    });
});
