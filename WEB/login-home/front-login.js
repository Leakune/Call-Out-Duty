// sk_test_i4aULkWvX5PbhuVTaR1ewGEt00V2PX1AEV

Stripe.setPublishableKey('pk_test_dbQT1JyUBd6sd8YxcvqSYmS8001hfpDRwN');

var $form = $('#payment-form'); // On récupère le formulaire
$form.submit(function (e) {
  e.preventDefault();
  $form.find('button').prop('disabled', true); // On désactive le bouton submit
  Stripe.card.createToken({
    number: $('.card-number').val(),
    cvc: $('.card-cvc').val(),
    exp_month: $('.card-expiry-month').val(),
    exp_year: $('.card-expiry-year').val()
  }, function (status, response) {
    if (response.error) { // Ah une erreur !
      // On affiche les erreurs
      $form.find('.payment-errors').text(response.error.message);
      $form.find('button').prop('disabled', false); // On réactive le bouton
    } else { // Le token a bien été créé
      var token = response.id; // On récupère le token
      // On crée un champs cachée qui contiendra notre token
      $form.append($('<input type="hidden" name="stripeToken" />').val(token));
      $form.get(0).submit(); // On soumet le formulaire
    }
  });
});
