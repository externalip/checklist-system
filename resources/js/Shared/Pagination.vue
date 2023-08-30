<template>
    <div class="flex items-center justify-between p-3 bg-white border-t border-gray-200 sm:px-6">
        <!-- Previous Button (hidden on mobile) -->
        <button @click="gotoPage(data.current_page - 1)" :class="['pagination-button', 'hidden', 'sm:block', { 'disabled': data.current_page <= 1 }]">
                        Previous
            </button>

        <div class="flex items-center justify-center flex-1">
            <!-- Flex layout added -->
            <nav class="relative z-0 inline-flex shadow-sm">
                <!-- Numbered Pages -->
                <template v-for="num in visiblePages" :key="num">
                            <button @click="gotoPage(num)"
                                :class="['pagination-button', num === data.current_page ? 'bg-blue-500 text-white' : 'text-gray-700 hover:text-gray-500']">
                                {{ num }}
                            </button>
</template>
            </nav>
        </div>

        <!-- Next Button (hidden on mobile) -->
       <button @click="gotoPage(data.current_page + 1)"
            :class="['pagination-button', 'hidden', 'sm:block', { 'disabled': data.current_page >= data.last_page }]"
            :disabled="data.current_page >= data.last_page">
             Next
        </button>
    </div>
</template>


<script>
export default {
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    computed: {
        firstItem() {
            return (this.data.current_page - 1) * this.data.per_page + 1;
        },
        lastItem() {
            return Math.min(this.data.current_page * this.data.per_page, this.data.total);
        },
        visiblePages() {
            const range = 2;
            const start = Math.max(1, this.data.current_page - range);
            const end = Math.min(this.data.last_page, this.data.current_page + range);

            const visiblePages = [];
            for (let i = start; i <= end; i++) {
                visiblePages.push(i);
            }

            return visiblePages;
        },
    },
    methods: {
        gotoPage(page) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            this.$inertia.visit(url.toString(), {
                preserveState: true,
                preserveScroll: true,
                replace: true,
                onSuccess: (page) => {
                    this.$inertia.remember(page);
                },
            });
        },
    },
};
</script>

<style scoped>
.pagination-button {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.25rem;
    color: #374151;
    background-color: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    margin-right: 0.25rem;
}

.pagination-button:hover {
    background-color: #f9fafb;
    border-color: #d1d5db;
}

.pagination-button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}

.pagination-button.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-button.bg-blue-500 {
    background-color: #3b82f6;
    color: white;
}

.pagination-button.text-gray-700 {
    color: #4b5563;
}

.pagination-button.hover:text-gray-500:hover {
    color: #6b7280;
}
</style>
