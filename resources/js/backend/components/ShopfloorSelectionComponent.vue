<template>
</template>
<script>
    export default {
        mounted() {
            $(".shopfloor").on("change", function(e){
			    var id_shopfloor = $(this).val();

			    $.get("{{ route('admin.auth.group_of_personnel.index') }}", {id_shopfloor: id_shopfloor});
			});
        }
    }
</script>


