<x-app-plugin.crm-service.leads.lead-info-closed :ticket-id="$ticket->id"/>
<x-app-plugin.crm.customers.card-profile :customer-id="$ticket->customer_id" :add-title="true" :soft-data="true" :config="$config"/>
<x-app-plugin.crm-service.leads.lead-info :add-des="true" :ticket-id="$ticket->id" :add-title="true"/>

