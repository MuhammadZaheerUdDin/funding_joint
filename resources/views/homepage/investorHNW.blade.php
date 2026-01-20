@extends('layouts.frontPage.page')


@section('content')
    <div class="container" style="margin-top:100px;">

        <!-- Section heading -->
        <h2 class="h1-responsive font-weight-bold text-center my-5">
            @inlineEditor( 'investorHWN-title' )
                Funding Joint Sophisticated investor / High Net Worth Individual Declaration
            @endInlineEditor
        </h2>
        <!-- Section description -->
        <p class="w-responsive mx-auto mb-5">
            @inlineEditor( 'investorHWN-content' )
            The Funding Joint Platform is a new and innovative approach to the traditional factoring model. Consequently, there may arise certain risks which may not be suitable for retail investors. As such, any investment opportunities listed on the Platform (or associated services) are currently only available to sophisticated investors, high net worth individuals and companies and institutions.
            For the avoidance of doubt, the Funding Joint Platform does not offer any investment of a specified kind or undertake any regulated activity under the Financial Services and Markets Act 2000. The specimen statements provided in the Financial Services and Markets Act (Financial Promotion) Order 2005 are being used as good industry practice and without prejudice to the above.

            Declaration for sophisticated investors:

            I declare that I am a self-certified sophisticated investor for the purposes of the Financial Services and Markets Act (Financial Promotion) Order 2005.
            I understand that this means that:
            a.     I can receive financial promotions that may not have been approved by a person authorised by the Financial Conduct Authority;
            b.    the content of such financial promotions may not conform to the rules issued by the Financial Conduct Authority;
            c.     by providing this statement I may lose significant rights;
            d.    I may have no right to complain to either of the following:
            i.    the Financial Conduct Authority; or
            ii.    the Financial Ombudsman Scheme;
            e.     I may have no right to seek compensation from the Financial Services Compensation Scheme.
            I also declare that I am a self-certified sophisticated investor because at least one of the following applies to me:
            f.     I am a member of a network or syndicate of business angels and have been so for at least the last six months prior to today’s date;
            g.    I have made more than one investment in an unlisted company in the two years prior to today’s date;
            h.     I am working, or have worked in the two years prior to today’s date, in a professional capacity in the private equity sector, or in the provision of finance for small and medium enterprises;
            i.      I am currently, or have been in the two years prior to today’s date, a director of a company with an annual turnover of at least £1 million.
            I accept that I can lose my property and other assets from making investment decisions based on financial promotions.
            I am aware that it is open to me to seek advice of someone who specialises in advising on investments.

            Declaration for high net worth individuals:

            I declare that I am a self-certified high net worth individual for the purposes of the Financial Services and Markets Act (Financial Promotion) Order 2005.
            I understand that this means that:
            a.     I can receive financial promotions that may not have been approved by a person authorised by the Financial Conduct Authority;
            b.    the content of such financial promotions may not conform to the rules issued by the Financial Conduct Authority;
            c.     by providing this statement I may lose significant rights;
            d.    I may have no right to complain to either of the following:
            i.    the Financial Conduct Authority; or
            ii.    the Financial Ombudsman Scheme;
            e.     I may have no right to seek compensation from the Financial Services Compensation Scheme.
            I also declare that I am a high net worth individual because at least one of the following applies to me:
            f.     I had, during the financial year immediately preceding today’s date, an annual income to the value of £100,000 or more;
            g.    I held, throughout the financial year immediately preceding today’s date, net assets to the value of £250,000 or more. Net assets for these purposes do not include:
            i.    the property which is my primary residence or any loan secured on that residence;
            ii.    any rights of mine under a qualifying contract of insurance within the meaning for the Financial Services and Markets Act 200 (Regulated Activities) Order 2001; or
            iii.    any benefits (in the form of pensions or otherwise) which are payable on the termination of my service or on my death or retirement and to which I am (or my dependants are), or may be, entitled.
            I accept that I can lose my property and other assets from making investment decisions based on financial promotions.
            I am aware that it is open to me to seek advice of someone who specialises in advising on investments.

            @endInlineEditor
        </p>
    </div>
@endsection