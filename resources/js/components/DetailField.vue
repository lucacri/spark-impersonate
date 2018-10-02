<template>

    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">

            </h4>
        </div>
        <div class="w-3/4 py-4">

            <a
                    @click="onClick"
                    class="cursor-pointer dim inline-block text-primary font-bold"
            >
                {{ __('Impersonate') }}
            </a>
        </div>
    </div>

</template>

<script>
	export default {
		props: ['resource', 'resourceName', 'resourceId', 'field'],
		methods: {
			onClick() {
				window.open(`/spark/kiosk/users/impersonate/${this.field.id}`, '_self');
			}
		}
	}
</script>
