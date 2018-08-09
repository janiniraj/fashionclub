<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<section id="services">
<?php echo $content_top; ?>
<div class="container">
<script>
$(function(){
	$('.mainbar div').hide();
	$('#tabs a').bind('click', function(e){
		$('#tabs a.current').removeClass('current');
		$('.mainbar div:visible').hide();
		$(this.hash).show();
		$(this).addClass('current');
		e.preventDefault();
	}).filter(':first').click();
});
</script>
<h2>Customer Services</h2>
<div class="sidebar">
<ul id="tabs">
	<li><a href="#tabs-1">Delivery</a></li>
	<li><a href="#tabs-2">Status</a></li>
	<li><a href="#tabs-3">Faulty Products</a></li>
	<li><a href="#tabs-4">Exchange</a></li>
	<li><a href="#tabs-5">Cancellation</a></li>
	<li><a href="#tabs-6">Terms &amp; Conditions</a></li>
	<!--
	<li><a href="#tabs-7">Effect</a></li>
	<li><a href="#tabs-8">How a Contract is formed</a></li>
	<li><a href="#tabs-9">Limitation of Liability</a></li>
	<li><a href="#tabs-10">Guarantee and complaints management</a></li>
	<li><a href="#tabs-11">Circumstances beyond our control (Force Majeure clause)</a></li>
	<li><a href="#tabs-12">Notices</a></li>
	<li><a href="#tabs-13">General</a></li>
	<li><a href="#tabs-14">Amendment to the General Business Terms and Conditions</a></li>
	<li><a href="#tabs-15">Terms of Use</a></li>
	<li><a href="#tabs-16">Availability of the Website, Security and Accuracy</a></li>
	<li><a href="#tabs-17">Our liability</a></li>
	<li><a href="#tabs-18">Registration for the Service</a></li>
	<li><a href="#tabs-19">Intellectual Property Rights</a></li>
	<li><a href="#tabs-20">Information about you and your visits to the Website</a></li>-->
</ul>
<a href="/?route=information/storelocation" id="store">
	<h3>Store<br>Locations</h3>
</a>
<div class="call">
	<h3>Need to speak to someone?</h3>
	<p>Call us at +603 8317 8888<br>
	10AM - 5PM (Monday - Friday)</p>
	<br>
	<p>Or Email us at <a href="mailto:info@fashionclub.my">info@fashionclub.my</a></p>
</div>
</div>
<div class="mainbar">
	<div id="tabs-1">
	<h3>Delivery</h3>
	<ol>
		<li>We aim to deliver the Product to you at the place of delivery requested by you in your Order.</li>
		<li>We aim to deliver within the time indicated by us at the time of your Order (and updated in the Confirmation of Order) but we cannot promise an exact date when you submit your Order or at the Confirmation of Order. We always aim to deliver within the stipulated time frame of any Order, which we accept but we cannot guarantee any firm delivery dates.</li>
		<li>We shall aim to let you know if we expect that we are unable to meet our estimated delivery date, but, to the extent permitted by law, we shall not be liable to you for any losses, liabilities, costs, damages, charges or expenses arising out of late delivery.</li>
		<li>On delivery of the Product, you may be required to sign for delivery. You agree to inspect the Product for any obvious faults, defects or damage before you sign for delivery. You need to keep receipt of the delivered Product in case of future discussions with us about it.</li>
		<li>Please note that it might not be possible for us to deliver to some locations. If this is the case, we will inform you using the contact details that you provide to us when you make your Order and arrange for cancellation of the Order or delivery to an alternative delivery address.</li>
		<li>We deliver in our standard packaging. Any special packaging requested by you is subject to additional charges.</li>
		<li>All risk in the Product shall pass to you upon delivery, except that, where delivery is delayed due to a breach of your obligations under a Contract, risk shall pass at the date when delivery would have occurred but for your breach. From the time when risk passes to you, we will not be liable for loss or destruction of the Product.</li>
		<li>You must take care when opening the Product so as not to damage it, particularly when using any sharp instruments.</li>
		<li>You shall ensure that you are ready for safe receipt of the Product without undue delay and at any time reasonably specified by us.</li>
		<li>If you are not available to take delivery or collection, we may leave a card giving you instructions on either re-delivery or collection from the carrier.</li>
		<li>If delivery or collection is delayed through your unreasonable refusal to accept delivery or if you do not (within two weeks of our first attempt to deliver the Product to you) accept delivery or collect the Product from the carrier, then we may (without affecting any other right or remedy available to us) do either or both of the following:</li>
		<li>charge you for our reasonable storage fee and other costs reasonably incurred by us; or</li>
		<li>no longer make the Product available for delivery or collection and notify you that we are immediately cancelling the applicable Contract, in which case we will refund to you or your credit or debit card company as applicable any money already paid to us under the applicable Contract, less our reasonable administration charges (including for attempting to deliver and then returning the Product, and any storage fees as provided for in clause 5.11(a) above).</li>
		<li>It is your responsibility to ensure that the Products are sufficient and suitable for your purposes and meet your individual requirements. We do not warrant that the Products will meet your individual requirements. You acknowledge that the Products are standard and not made bespoke to fit any particular requirements that you may have.</li>
	</ol>
	<!-- END Delivery -->
	</div>
	
	<div id="tabs-2">
	<h3>Status</h3>
	<p>To place an order with Fashion Club you must be over 18 years of age and possess a valid credit or debit card issued by a bank acceptable to us.</p>
	<!-- END Status -->	
	</div>
	
	<div id="tabs-3">
	<h3>Faulty Products</h3>
	<p>We warrant that:</p>
	<ol>
		<li>the Product will be delivered undamaged in the quantities ordered; and</li>
		<li>the Product will conform with the manufacturer's latest published instructions as set out on the Site or in our Product material at the time of your Order.</li>
		<li>The Product is intended to be used strictly in accordance with the manufacturer's latest published instructions as set out on the Site or as on the Product itself. It is your responsibility to ensure that you use the Product strictly in accordance with those instructions.</li>
		<li>Before delivery, we may make minor adjustments to material, colour, weight, measurements, design and other features to the extent that they are reasonable.</li>
		<li>We try very hard to deliver Products in excellent condition. However, if you tell us that the Product is faulty, you agree to keep the Product in its current condition available for us (or our agent) to inspect within a reasonable time.</li>
		<li>In order to provide you with any remedies for a faulty Product, we may need your assistance and prompt provision of certain information regarding the Product, including:</li>
		<li>you specifying with reasonable detail the way in which it is alleged that the Product is damaged or defective; and</li>
		<li>you providing us with the delivery note number and such other information as we reasonably require.</li>
		<li>If you would like us to repair, replace or provide a refund for the Product where it did conform to the applicable Contract, and we find that the Product has:</li>
		<li>been misused, abused or subjected to neglect, improper or inadequate care, carelessness, damage or abnormal conditions; or</li>
		<li>been involved in any accident or damage caused by an incorrect attempt at modification or repair; or</li>
		<li>been dealt with or used contrary to our or the manufacturer's instructions for the Product; or</li>
		<li>deteriorated through normal wear and tear, after delivery by us, we may at our discretion decide not to repair, replace or refund you for the Product and/or we may require you to pay all reasonable carriage costs and servicing costs at our current standard fees and costs and charge this to your credit or debit card, or the payment details that you provided to us when you made your Order, and, to the extent permitted by law, we shall not be liable to you for any losses, liabilities, costs, damages, charges or expenses as a result.</li>
	</ol>
	<!-- END Faulty Products -->
	</div>
	
	<div id="tabs-4">
	<h3>Exchange</h3>
	<ol>
		<li>All items must be exchanged in their original condition with all tags attached.</li>
		<li>Only returns via courier service is accepted, as we do not honour any walk-ins.</li>
	</ol>
	<p>Store credit can be used to make future purchases through our website. In the event that we send you a wrong item or the item is defective, we will send you a replacement item. Should the item be out of stock, we will issue a cash refund.</p>
	<!-- END Exchange -->
	</div>
	
	<div id="tabs-5">
	<h3>Cancellation</h3>
	<ol>
		<li>We may cancel a Contract if the Product is not available for any reason. We will notify you if this is the case and return any payment that you have made.</li>
		<li>We will usually refund any money received from you using the same method originally used by you to pay for the Product.</li>
	</ol>
	
	<h3>Cancellation by Customer (Non-Faulty Product)</h3>
	<p>We do not accept any cancellations after the final payment is made.</p>
	<!-- END Cancellation -->
	</div>
	
	<div id="tabs-6">
	<h3>Introduction</h3>
	<p>We are Limkokwing Fashion Club Sdn Bhd, Inovasi 1-1, Jalan Teknokrat 1/1, 63000 Cyberjaya, Selangor, Malaysia, trading as www.fashionclub.my and its subsidiaries, associates and officers unless otherwise stated.</p>
	<p>These Terms and Conditions govern the supply by us of any Product ordered by you on the Site. By agreeing to order a Product, you agree to be legally bound by these Terms and Conditions.</p>
	<p>In these Terms and Conditions:</p>
	<ol>
		<li>"Account" means the account that you will need to register for on the Site if you would like to submit an Order on the Site;</li>
		<li>"Acknowledgement" means our acknowledgement of your Order by email;</li> 
		<li>"Breach of Duty" has the meaning given to it in clause 10.11(b) of these Terms and Conditions;</li> 
		<li>"Business Day" means a day which is neither (i) a Saturday or Sunday, nor (ii) a public holiday anywhere in Malaysia;</li> 
		<li>"Confirmation of Order" means our email to you, in which we accept your Order in accordance with clause 4.9 below;</li> 
		<li>"Contract" means your Order of a Product or Products in accordance with these Terms and Conditions which we accept in accordance with clause 4.9 below;</li> 
		<li>"Customer" means individual who places an Order on the Site;</li> 
		<li>"Liability" has the meaning given to it in clause 10.11(a) of these Terms and Conditions;</li>
		<li>"Order" means the order submitted by you to the Site to purchase a Product from us;</li>
		<li>"you" means the Customer who places an Order;</li>
		<li>references to "clauses" are to clauses of these Terms and Conditions;</li> 
		<li>headings are for ease of reference only and shall not affect the interpretation or construction of the Terms and Conditions;</li>
		<li>words imparting the singular shall include the plural and vice versa. Words imparting a gender shall include every gender and references to persons shall include an individual, company, corporation, firm or partnership;</li>
		<li>references to "includes" or "including" or like words or expressions shall mean without limitation.</li>
	</ol>
	<p>These Terms and Conditions are our copyrighted intellectual property. Use by third parties – even of extracts – for the commercial purposes of offering goods and/or services– is not permitted. Infringements may be subject to legal action.</p>
	<!-- END Introduction -->

	<h3>Effect</h3>
	<p>These Terms and Conditions shall apply to all Orders and Contracts made or to be made by us for the sale and supply of Products. When you submit an Order to us, give any delivery instruction or accept delivery of the Products, this shall in any event constitute your unqualified acceptance of these Terms and Conditions. Nothing in these Terms and Conditions affects your statutory rights (including the right to insist that goods you buy from businesses must correspond with their description, be fit for their purpose and be of satisfactory quality).</p> 
	<p>These Terms and Conditions shall prevail over any separate terms put forward by you. Any conditions that you submit, propose or stipulate in whatever form and at whatever time, whether in writing, by email or orally, are expressly waived and excluded.</p>
	<p>No other terms or changes to the Terms and Conditions shall be binding unless agreed in writing signed by us.</p>
	<!-- END Effect -->

	<h3>How a Contract is formed</h3>
	<ol>
		<li>When making an Order, you must register for an Account on the Site as detailed in clause 10, and you must follow the instructions on the Site as to how to make your Order and for making changes to your prospective Order before you submit it to the Site.</li>
		<li>Irrespective of any previous price you have seen or heard, once you select a Product that you wish to Order, you will then be shown or told (on the Site) the charges you must pay including taxes, if applicable, and any applicable delivery charges. Unless otherwise stipulated on the Site, all charges are in the currency then in force in Malaysia. Subject to clause 3.11 below, this is the total that you will pay for receipt of the ordered Product.</li>
		<li>You shall pay for the Product in full at the time of ordering by supplying us with your credit or debit card details from a credit or debit card company acceptable to us or by Paypal, which we require in order to process your Order. Alternatively, you may pay by any method that we have said is acceptable to us, but in any event we shall not be bound to supply before we have received cleared funds in full. Your payment will be received by our agent.</li>
		<li>If you are asked for details of a payment card, you must be fully entitled to use that card or account. The card or account must have sufficient funds to cover the proposed payment to us.</li>
		<li>You undertake that all details you provide to us for the purpose of purchasing the Product from us will be correct, that the credit or debit card, or account or other payment method which you use is your own and that there are sufficient funds or credit facilities to cover the cost of the Product. We reserve the right to obtain validation of your payment details before providing you with the Product.</li>
		<li>When you submit an Order to the Site, you agree that you do so subject to these Terms and Conditions current at the date you submit your Order. You are responsible for reviewing the latest Terms and Conditions each time you submit your Order.</li>
		<li>Your Order remains valid as an offer until we issue our Confirmation of Order or, if earlier, when we receive your notice revoking your Order.</li>
		<li>We shall not be obliged to supply the Product to you until we have accepted your Order. Unless expressly stating that we accept your order, an email, letter, fax or other Acknowledgement of your Order by us is purely for information purposes and does not constitute the Confirmation of Order. In that Acknowledgement, we may give you an Order reference number and details of the Product you have ordered. We may in our discretion refuse to accept an Order from you for any reason, including unavailability of supplies or we may offer you an alternative Product (in which case we may require you to re-submit your Order first).</li>
		<li>Contract shall be formed and we shall be legally bound to supply the Product to you when we accept your Order. Acceptance shall take place when we expressly accept your Order by email to you, in the form of a document called a "Confirmation of Order" stating that we are accepting your Order. Our Confirmation of Order shall be deemed to come into effect when it has been dispatched by us. Without affecting your obligation to pay us earlier, we may send an invoice to you at any time after we have accepted your Order. Until the time when we accept your Order, we reserve the right to refuse to process your Order.</li>
		<li>If you discover that you have made a mistake with your Order after you have submitted it to the Site, please contact info@fashionclub.my immediately. However, we cannot guarantee that we will be able to amend your Order in accordance with your instructions.</li>
		<li>We try very hard to ensure that the price given to you is accurate, but the price of your Order will need to be validated by us as part of our acceptance procedure. If the price for the Order changes before we accept your Order, we will contact you and ask you to confirm that you wish to proceed at the amended price.</li>
		<li>A Contract will relate only to those Products whose dispatch we have confirmed in the Confirmation of Order. We will not be obliged to supply any other Products which may have been part of your Order until we have sent a Confirmation of Order in relation to those Products.</li>
		<li>You must only submit to us or our agent or the Site information which is accurate and not misleading and you must keep it up to date and inform us of changes.</li>
	</ol>
	<!-- END How a Contract is formed -->

	<h3>Limitation of Liability</h3>
	<p>This clause 10 prevails over all other clauses and sets forth our entire Liability, and your sole and exclusive remedies, for:</p>
	<!-- END Limitation of Liability -->

	<h3>Guarantee and complaints management</h3>
	<ol>
		<li>We shall perform our obligations under these Terms and Conditions with reasonable skills and care.</li>
		<li>We place great value on our customer satisfaction. You may contact us at any time using the contact details given in clause 1.1 of these Terms and Conditions. We will attempt to address your concerns as soon as reasonably possible and will contact you on receipt of any relevant enquiry or complaint. In guarantee cases, the manufacturer frequently must be involved, and as such it may take longer to resolve such an enquiry or complaint.</li>
		<li>In the event of a complaint it will help us if you can describe the object of your complaint as accurately as possible and, where applicable, send us copies of the Order or at least the order number that we assign you in the Acknowledgement or Confirmation of Order. Should you not have received any reaction from us within five Business Days, please make further enquiries. In rare cases your emails may be caught up in our spam filters or not reach us, or correspondence that we send to you may otherwise not have reached you.</li>
	</ol>
	<!-- END Guarantee and complaints management -->

	<h3>Circumstances beyond our control (Force Majeure clause)</h3>
	<ol>
		<li>We shall not be liable to you for any breach, hindrance or delay in the performance of a Contract attributable to any cause beyond our reasonable control, including without limitation any natural disaster and unavoidable incident, actions of third parties (including without limitation hackers, suppliers, governments, quasi-governmental, supra-national or local authorities), insurrection, riot, civil commotion, war, hostilities, warlike operations, national emergencies, terrorism, piracy, arrests, restraints or detainments of any competent authority, strikes or combinations or lock-out of workmen, epidemic, fire, explosion, storm, flood, drought, weather conditions, earthquake, natural disaster, accident, mechanical breakdown, third party software, failure or problems with public utility supplies (including electrical, telecoms or Internet failure), shortage of or inability to obtain supplies, materials, equipment or transportation ("Event of Force Majeure"), regardless of whether the circumstances in question could have been foreseen.</li>
		<li>Either you or we may terminate a Contract forthwith by written notice to the other in the event that the Event of Force Majeure lasts for a period of two Business Days or more, in which event neither you nor we shall be liable to the other by reason of such termination (other than for the refund of a Product already paid for by you and not delivered).</li>
		<li>If we have contracted to provide identical or similar Products to more than one Customer and are prevented from fully meeting our obligations to you by reason of an Event of Force Majeure, we may decide at our absolute discretion which contracts we will perform and to what extent.</li>
	</ol>
	<!-- Circumstances beyound our control -->

	<h3>Notices</h3>
	<ol>
		<li>Any notice under a Contract shall be in writing and may be served by personal delivery or by pre-paid or recorded delivery letter or by email addressed to the relevant party at the address or email address of the relevant party last known to the other.</li>
		<li>Any notice given by post shall be deemed to have been served two Business Days after the same has been posted if the recipient address is in the country. Any notice given by email shall be deemed to have been served when the email has been proved to be received by the recipient’s server. In proving such service it shall be sufficient to prove that the letter or email was properly addressed and, as the case may be, posted as a prepaid or recorded delivery letter or dispatched or a delivery report received.</li>
	</ol>
	<!-- END Notices -->

	<h3>General</h3>
	<ol>
		<li>We shall keep a record of your Order and these Terms and Conditions until six years after we have accepted your Order. However, for your future reference, we advise you to print and keep a copy of these Terms and Conditions, your Order, the Acknowledgement and the Confirmation of Order.</li>
		<li>No failure or delay by us or you in exercising any right under these Terms and Conditions or a Contract shall operate as a waiver of such right or extend to or affect any other or subsequent event or impair any rights or remedies in respect of it or in any way modify or diminish our or your rights under these Terms and Conditions or a Contract.</li>
		<li>If any clause in these Terms and Conditions or a Contract shall become or shall be declared by any court of competent jurisdiction to be invalid or unenforceable, such invalidity or unenforceability shall in no way affect any other clause or part of any clause, all of which shall remain in full force and effect, so long as these Terms and Conditions or a Contract shall be capable of continuing in effect without the unenforceable term.</li>
		<li>You shall not assign, transfer, novate, charge, sub-contract, create any trust over or deal in any other manner with these Terms and Conditions or a Contract or all or any of your rights or obligations under these Terms and Conditions or a Contract.</li>
		<li>Nothing in these Terms and Conditions or a Contract shall create or be deemed to create a partnership, an agency or a relationship of employer and employee between you and us.</li>
		<li>No person who is not a party to these Terms and Conditions or a Contract shall acquire any rights under it or be entitled to benefit from any of its terms even if that person has relied on any such term or has indicated to any party to these Terms and Conditions or that Contract its assent to any such term.</li>
		<li>These Terms and Conditions and a Contract (and all non-contractual obligations arising out of or connected to them) shall be governed and construed in accordance with Malaysia Law. Both we and you hereby submit to the non-exclusive jurisdiction of the Malaysia Courts. All dealings, correspondence and contacts between us shall be made or conducted in the English language.</li>
	</ol>
	<!-- END General -->

	<h3>Amendment to the General Business Terms and Conditions</h3>
	<p>We reserve the right to amend these Terms and Conditions at any time. All amendments to these Terms and Conditions will be posted on-line. However, continued use of the Site will be deemed to constitute acceptance of the new Terms and Conditions.</p>
	<!-- END Amendment to the General Business Terms and Conditions -->

	<h3>Terms of Use</h3>
	<ol>
		<li>This page (together with the documents referred to on it) tells you the terms of use (the “Terms of Use”) on which you may make use of our website www.fashionclub.my (the “Website”), whether as a guest or a registered user. Please read these terms of use carefully before you start to use the Website. By using the Website, you indicate that you accept these Terms of Use and that you agree to abide by them. Your use of any part of the Website constitutes your acceptance of these Terms of Use which takes effect on the date on which you first use the Website. If you do not agree with these Terms of Use, you should cease using the Website immediately.</li>
		<li>We reserve the right to change these Terms of Use at any time without notice to you by posting changes online. You are responsible for regularly reviewing information posted online to obtain timely notice of such changes. Your continued use of the Website after changes are posted constitutes your acceptance of the amended Terms of Use.</li>
		<li>You are responsible for all access to the Website through your Internet connection and for bringing these Terms of Use to the attention of all such persons.</li>
		<li>You hereby grant to us an irrevocable, royalty-free, worldwide, assignable, sub-licensable licence to use any material which you submit to us or the Website for the purpose of use on the Website or for generally marketing (by any means and in any media) our services. You agree that you waive your moral rights to be identified as the author and we may modify your submission.</li>
		<li>Commentary and other materials posted on the Website are not intended to amount to advice on which reliance should be placed. We therefore disclaim all liability and responsibility arising from any reliance placed on such materials by any visitor to the Website, or by anyone who may be informed of any of its contents.</li>
		<li>You agree to comply at all times with any instructions for use of the Website which we make from time to time.</li>
	</ol>
	<!-- END Term of Use -->

	<h3>Availability of the Website, Security and Accuracy</h3>
	<ol>
		<li>Whilst we endeavour to make the Website available 24 hours a day, we cannot be liable if for any reason the Website is unavailable for any time or for any period. We make no warranty that your access to the Website will be uninterrupted, timely or error-free. Due to the nature of the Internet, this cannot be guaranteed. In addition, we may occasionally need to carry out repairs, maintenance or introduce new facilities and functions.</li>
		<li>Access to the Website may be suspended or withdrawn to or from you personally or all users temporarily or permanently at any time and without notice. We may also impose restrictions on the length and manner of usage of any part of the Website for any reason. If we impose restrictions on you personally, you must not attempt to use the Website under any other name or user.</li>
		<li>We do not warrant that the Website will be compatible with all hardware and software which you may use. We shall not be liable for damage to, or viruses or other code that may affect, any computer equipment, software, data or other property as a result of your access to or use of the Website or your obtaining any material from, or as a result of using, the Website. We shall also not be liable for the actions of third parties.</li>
		<li>We may change or update the Website and anything described in it without notice to you.</li>
		<li>Whilst we endeavour to ensure that information and materials on the Website are correct, no warranty or representation, express or implied, is given that they are complete, accurate, up-to-date, fit for a particular purpose and, to the extent permitted by law, we do not accept any liability for any errors or omissions. This shall not affect any obligation which we may have under any contract that we may have with you to provide you with services, including any obligation that we may have under that contract to provide you with accurate information and advice, and which we may do through a secure part of the Website available to people who use the appropriate password.</li>
		<li>The material contained on the Website is provided for information purposes only and it shall not give rise to any commitment or obligation by us. Any information on the Website shall not constitute any part of an offer or contract.</li>
	</ol>
	<!-- END Availability of the Website, Security and Accuracy -->

	<h3>Our liability</h3>
	<ol>
		<li>We accept liability for death or personal injury caused by our negligence, or for our fraudulent misrepresentation or for any liability that we cannot exclude or limit at law.</li>
		<li>To the extent possible by law and subject to paragraph 22 above, in all cases other than in respect of services that we provide for a specific consumer (which shall be governed by its own contractual terms and terms of engagement), to the extent permitted by law:<br>
			<ol>
				<li>Our total Liability to you or any third party shall in no circumstances exceed, in aggregate, a sum equal to the greater of: i) RM500; or ii) 110% of any aggregate amount paid by you to us in the 12 months preceding any cause of action arising; and</li>
				<li>we shall not have any liability (whether in contract, tort, negligence, misrepresentation, restitution or under any legal head of liability) in relation to your use or inability to use or delay in use of the Website or any material in it or accessible from it or from any action or decision taken as a result of using the Website or any such material for any: (a) indirect or consequential losses, damages, costs or expenses; (b) loss of actual or anticipated profits; (c) loss of contracts; (d) loss of use of money; (e) loss of anticipated savings; (f) loss of revenue; (g) loss of goodwill; (h) loss of reputation; (i) loss of business; (j) loss of operation time; (k) loss of opportunity; or (l) loss of, damage to or corruption of, data; whether or not such losses were reasonably foreseeable or we had been advised of the possibility of you incurring such losses. For the avoidance of doubt, (b) to (l) apply whether such losses are direct, indirect, consequential or otherwise.</li>
			</ol>
		</li>
		<li>If you enter into a contract with us by submitting an order for a product through the Website which is accepted by us in accordance with our Terms and Conditions, the relevant provisions of those Terms and Conditions relating to our liability and its limitation in relation to such a contract shall replace the limitation of liability provisions in clause 22.a above.</li>
	</ol>
	<!-- END Our liability -->

	<h3>Registration for the Service</h3>
	<ol>
		<li>If you would like to submit an order to the Website to purchase one of the products listed on the Website, you will need to register for an account on the Website (an “Account”) which you will be able to access on the Website through the “My User Account” part of the Website. To register you need to supply us with your name, postcode and email address and possibly some other personal information. Once you register with the Website, you will be asked to create a username for, and allocate a password to, your Account. You must keep the password confidential and immediately notify us if any unauthorised third party becomes aware of that password or if there is any unauthorised use of your email address or your Account or any breach of security known to you. You agree that any person to whom your user name or password is disclosed is authorised to act as your agent for the purposes of using (and/or transacting via) your Account. Please note that you are entirely responsible if you do not maintain the confidentiality of your password.</li>
		<li>Your must be registered with a valid personal email address that you access regularly, so that, among other things, administration emails can be sent to you. Any Accounts which have been registered with someone else's email address or with temporary email addresses may be closed without notice. We may require you to validate Accounts at registration or if we believe you have been using an invalid email address.</li>
		<li>We reserve the right to close your Account, if you are found to have any intentions or actions that disrupts the Website in any way.</li>
		<li>When you register for an Account, and whenever you log on to your Account thereafter, you have the option to sign up to receive, and to opt out of receiving, information emails (such as newsletters, information on offers, offers from our sister companies etc). You are able to unsubscribe from such information emails at any time by logging in to your Account or by sending an email to unsubscribe.</li>
		<li>Although we save the information relating to any order that you submit to the Website to purchase one of the products listed on the Website, you will be unable to directly retrieve this information for security reasons. You may access this information by logging in to your Account. You will be able to view information relating to your completed, open or recently dispatched orders and manage and save your address information, any bank details and any newsletter to which you may have subscribed.</li>
	</ol>
	<!-- END Registration for the Service -->

	<h3>Intellectual Property Rights</h3>
	<ol>
		<li>We are the owner or the licensee of all intellectual property rights in the Website, and in the material published on it. Those works are protected by copyright laws and treaties around the world. All such rights are reserved.</li>
		<li>You may print off one copy, and may download extracts, of any page(s) from the Website for your personal reference and you may draw the attention of others within your organisation to material posted on the Website.</li>
		<li>You must not modify the paper or digital copies of any materials you have printed off or downloaded in any way, and you must not use any illustrations, photographs, video or audio sequences or any graphics separately from any accompanying text.</li>
		<li>You must not use any part of the materials on the Website for commercial purposes without obtaining a license to do so from us or our licensors.</li>
		<li>If you print off, copy or download any part of the Website in breach of these Terms of Use, your right to use the Website will cease immediately and you must, at our option, return or destroy any copies of the materials you have made.</li>
	</ol>
	<!-- END Intellectual Property Rights -->

	<h3>Information about you and your visits to the Website</h3>
	<p>We process information about you in accordance with our Privacy Policy. By using the Website, you consent to such processing and you warrant that all data provided by you is accurate.</p>
	<!-- END Information about you and your visits to the Website --> 
	</div>
	
</div>
<div class="clear"></div>
<?php echo $content_bottom; ?>
</div>
</section>
<?php echo $footer; ?>