paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            application_context: {
             shipping_preference: "NO_SHIPPING"
            },
            payer: {
             email_address: '{{ $user->email }}',
             name: {
                 given_name: '{{ $user->names }}',
                 surname: '{{ $user->surnames }}'
             },
             phone: {
                 phone_number: {
                     national_number: '{{ $user->phone_number }}',
                     country_code: '57'
                 }
             },
             address: {
                 country_code: 'CO'
             }
            },
            purchase_units: [{
                amount: {
                    value: "{{ intval(Cart::total()}}"
                }
            }]
        })
},
onApprove: function (data, actions) {
     return actions.order.capture().then(function(details)
     {
         alert(`Transacción hecha por  ${details.payer.name.given_name}!`)
     })
 },
 onError: function (err) {
     alert(err);
 }
}).render("#paypal-button-container");