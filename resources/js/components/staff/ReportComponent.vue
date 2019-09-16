<!--
  - Copyright (c) 2019.
  -
  - @Author Fabio Dijkshoorn nouw@nouw.xyz
  -->

<template>
    <table class="table dataTable my-0" id="dataTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Reported</th>
            <th>Reporter</th>
            <th>Reason</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="report in reports">
            <td>{{ report.id }}</td>
            <td>{{ report.reported }}</td>
            <td>{{ report.reporter }}</td>
            <td>{{ report.reason }}</td>
            <td>{{ report.typeOfReport }}</td>
            <td><button class="btn btn-sm btn-danger"><i class="fa fa-hammer"></i> </button>
                <button class="btn btn-warning btn-sm"><i class="fa fa-exclamation-triangle"></i> </button>
                <button class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data() {
            return {
                fields: {},
                errors: {},
                success: false,
                error: "",
                reports: []
            }
        },

        created() {
            axios.get('/staff/reports/fetch').then(response => {
                this.reports = response.data;
            });
        },

        computed: {
            reverseTasks() {
                return this.reports.slice().reverse();
            }
        },
    }
</script>

<style scoped>

</style>

