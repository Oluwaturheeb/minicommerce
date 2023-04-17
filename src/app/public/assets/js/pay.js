function payWithPaystack() {
  var form = $('form.form-active');
  var info = $('#info');
  var handler = PaystackPop.setup({
      key: 'pk_test_2fbaed4ea9db1082b9492b7c2678c8fc741dd869', // Replace with your public key
      email: form.find('input[name=email]').val(),
      amount: form.find('input[name=amount]').val() * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
      currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
      ref: '' + Math.floor((Math.random() * 1000000000) + 1), // Replace with a reference you generated
      callback: function (response) {
          $('input[name=ref]').remove();
          var ref = response.reference;
          form.append(`<input type="hidden" name="ref" value="${ref}" />`);
          $.ajax({
              url: '/process-transactions',
              type: 'post',
              beforeSend: () => {
                  info.html('Processing...')
                  $('button.submit').attr('disabled', 'disabled');
              },
              data: form.serialize(),
              success: res => {
                  res = JSON.parse(res);
                  if (res.code == '000') {
                      let id = $('.active').attr('data-id');
                      $('.buttons button').toggle();
                      info.html('Transaction completed!!!');
                      if (res.purchased_code) {
                          $('.transaction-details').append(`
                              <div class="mb-3 row">
                              <label for="amount" class="col-4 col-form-label">Transaction Token</label>
                              <div class="col-8">
                                  ${res.purchased_code}
                              </div>
                              </div>
                          `);
                      }
                      $('.transaction-details').append(`
                          <div class="mb-3 row">
                          <label for="amount" class="col-4 col-form-label">TransactionId</label>
                          <div class="col-8">
                              ${res.content.transactions.transactionId}
                          </div>
                          </div>
                          <div class="mb-3 row">
                          <label for="amount" class="col-4 col-form-label">Transaction Status</label>
                          <div class="col-8">
                              ${res.content.transactions.status}
                          </div>
                          </div>
                      `);

                      $.ajax({
                          url: '/confirm-transaction/' + res.requestId,
                          success: res => {
                              $('.col-sm-8 .card').hide();
                              $('.jumbo div').children('img').prop('src', false);
                          }
                      })
                  } else {
                      info.html('Transaction failed: ' + res.response_description);
                      $('button.submit').prop('disabled', false);
                  } 
              },
              error: () =>  $('button.submit').prop('disabled', false),
          });
          // Make an AJAX call to your server with the reference to verify the transaction
      },
      onClose: function () {
          info.html('Failed!');
      },
  });
  handler.openIframe();
}