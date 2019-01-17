<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
    <div class="app-content content">
        <div class="content-body">
            <section class="card">
                <div id="invoice-template" class="card-body">
                    <div id="invoice-company-details" class="row">
                        <div class="col-md-6 col-sm-12 text-center text-md-left">
                            <div class="media">
                                <img src="{{asset('img/logo.png')}}" alt="company logo" class="" width="150px" />
                                <div class="media-body">
                                    <ul class="ml-2 px-0 list-unstyled">
                                        <li class="text-bold-800">Stack Creative Studio</li>
                                        <li>4025 Oak Avenue,</li>
                                        <li>Melbourne,</li>
                                        <li>Florida 32940,</li>
                                        <li>USA</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-center text-md-right">
                            <h2>INVOICE</h2>
                            <p class="pb-3"># INV-001001</p>
                            <ul class="px-0 list-unstyled">
                                <li>Balance Due</li>
                                <li class="lead text-bold-800">$ 12,000.00</li>
                            </ul>
                        </div>
                    </div>
                    <div id="invoice-customer-details" class="row pt-2">
                        <div class="col-sm-12 text-center text-md-left">
                            <p class="text-muted">Bill To</p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-center text-md-left">
                            <ul class="px-0 list-unstyled">
                                <li class="text-bold-800">Mr. Bret Lezama</li>
                                <li>4879 Westfall Avenue,</li>
                                <li>Albuquerque,</li>
                                <li>New Mexico-87102.</li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-12 text-center text-md-right">
                            <p><span class="text-muted">Invoice Date :</span> 06/05/2016</p>
                            <p><span class="text-muted">Terms :</span> Due on Receipt</p>
                            <p><span class="text-muted">Due Date :</span> 10/05/2016</p>
                        </div>
                    </div>
                    <div id="invoice-items-details" class="pt-2">
                        <div class="row">
                            <div class="table-responsive col-sm-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item & Description</th>
                                            <th class="text-right">Rate</th>
                                            <th class="text-right">Hours</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>
                                                <p>Create PSD for mobile APP</p>
                                                <p class="text-muted">Simply dummy text of the printing and typesetting industry.</p>
                                            </td>
                                            <td class="text-right">$ 20.00/hr</td>
                                            <td class="text-right">120</td>
                                            <td class="text-right">$ 2400.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>
                                                <p>iOS Application Development</p>
                                                <p class="text-muted">Pellentesque maximus feugiat lorem at cursus.</p>
                                            </td>
                                            <td class="text-right">$ 25.00/hr</td>
                                            <td class="text-right">260</td>
                                            <td class="text-right">$ 6500.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>
                                                <p>WordPress Template Development</p>
                                                <p class="text-muted">Vestibulum euismod est eu elit convallis.</p>
                                            </td>
                                            <td class="text-right">$ 20.00/hr</td>
                                            <td class="text-right">300</td>
                                            <td class="text-right">$ 6000.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 col-sm-12 text-center text-md-left">

                            </div>
                            <div class="col-md-5 col-sm-12">
                                <p class="lead">Total due</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="text-right">$ 14,900.00</td>
                                            </tr>
                                            <tr>
                                                <td>TAX (12%)</td>
                                                <td class="text-right">$ 1,788.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-800">Total</td>
                                                <td class="text-bold-800 text-right"> $ 16,688.00</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Made</td>
                                                <td class="pink text-right">(-) $ 4,688.00</td>
                                            </tr>
                                            <tr class="bg-grey bg-lighten-4">
                                                <td class="text-bold-800">Balance Due</td>
                                                <td class="text-bold-800 text-right">$ 12,000.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="invoice-footer">
                        <h6>Terms & Condition</h6>
                        <p>You know, being a test pilot isn't always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>