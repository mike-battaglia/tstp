# Commonly Used Shortcodes

```php
// Memberships Content Restriction
[wcm_restrict plans="all-access, man-ed, con-ed, sales-tax-vip"] Only members can see me. [/wcm_restrict]

// Non-members
[wcm_nonmember] Only non-members can see me. [/wcm_nonmember]

// Subscribers
[subscribers_content] Active or pending subscribers can see me. [/subscribers_content]

// Non-subscribers
[nonsubscribers_content] Anybody without an active or pending subscription can see me. [/nonsubscribers_content]

[user_first_name] displays user first name.

[loggedout_content] Logged out users see me. [/loggedout_content]

[loggedin_content] Logged in users see me. [/loggedin_content]

[subscription_link]

[claimseat]

[getallaccess]

[wcm_restrict][get_access][/wcm_restrict][wcm_nonmember][nonmembers_prompt][/wcm_nonmember]

```

```
Subscription: [subscribers_content]🟢[/subscribers_content][nonsubscribers_content]🔴[/nonsubscribers_content]
Seat: [wcm_restrict]🟢[/wcm_restrict][wcm_nonmember]🔴[/wcm_nonmember]

SeatA: [wcm_restrict plans="all-access"]🟢[/wcm_restrict][wcm_nonmember plans="all-access"]🔴[/wcm_nonmember]
SeatC: [wcm_restrict plans="con-ed"]🟢[/wcm_restrict][wcm_nonmember plans="con-ed"]🔴[/wcm_nonmember]
SeatM: [wcm_restrict plans="man-ed"]🟢[/wcm_restrict][wcm_nonmember plans="man-ed"]🔴[/wcm_nonmember]
SeatV: [wcm_restrict plans="sales-tax-vip"]🟢[/wcm_restrict][wcm_nonmember plans="sales-tax-vip"]🔴[/wcm_nonmember]
```

- [WC Subs Docs - Filters](https://woocommerce.com/document/subscriptions/develop/filter-reference/)
- [WC Members Docs - Restrict Content](https://woocommerce.com/document/woocommerce-memberships-restrict-content/#:~:text=Restriction%20shortcode,as%20tutorial%20videos%20or%20infographics.)

---
[posts_table post_type="contractor-data" columns="title:Purchase Of,content:Details,excerpt:Category,cf:description:More Info,tax:relationship:Company,tax:job-type:Client,tax:work-type:Performing,cf:taxability_status:Taxability,favorite,notes" filters="true"]
