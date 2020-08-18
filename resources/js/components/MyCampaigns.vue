<template>
    <div>
        <div>
            <div v-if="!campaigns.length">
                <span class="h5">Getting information please wait...</span>
            </div>
            <div class="list-group" v-if="campaigns.length">
                <a :href="'/my-campaigns/' + campaign.id" class="list-group-item list-group-item-action"
                    v-for="(campaign,index) in campaigns" :key="'campaign-' + index"
                >
                    <h5 class="mb-1">{{campaign.name}}</h5>
                    <div class="text-right">
                        <span class="text-muted">
                            <span v-if="campaign.status == 0">New</span>
                            <span v-if="campaign.status == 1">Pending...</span>
                            <span v-if="campaign.status == 2">Sending in progress</span>
                            <span v-if="campaign.status == 3">Sent</span>
                            <span v-if="campaign.status == 16">Cancelled</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MyCampaigns",
        data(){
            return {
                campaigns: [],
            };
        },
        mounted() {
            this.fetchMyCampaigns();
        },
        methods: {
            /**
             * 
             */
            fetchMyCampaigns(){
                axios.get('/api/my-campaigns').then(resp => this.campaigns = resp.data);
            }
        }
    }
</script>

<style scoped>

</style>
