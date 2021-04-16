@component('mail::message')
# Du nouveau sur votre site de vente Shopify

Un nouveau produit vient d'être ajouté sur votre plateforme Shopify
N'hésitez à consulter


@component('mail::button', ['url' => url('produits')])
Voir le produit
@endcomponent

Merci
{{ config('app.name') }}
@endcomponent
