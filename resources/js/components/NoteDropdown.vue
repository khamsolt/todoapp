<template>
    <div class="dropdown">
        <button class="btn btn-sm btn-link p-0 border-0"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <div class="dropdown-menu">
            <slot/>
        </div>
    </div>
</template>
<script>
    export default {};
</script>
