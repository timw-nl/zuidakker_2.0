# Zuidakker Booking System Documentation

## Overview

The Zuidakker Booking System is a comprehensive WordPress solution that integrates with WooCommerce to manage bookable resources including boat berths, small allotments, meeting rooms, and accommodation. The system supports both free and professional (paid) booking tiers.

## Features

### Core Functionality
- **Custom Post Types**: Bookable Resources and Reservations
- **Resource Types**: Boat Berth, Small Allotment, Meeting Room, Accommodation
- **Two-Tier System**: Free and Professional (paid) bookings
- **WooCommerce Integration**: Automatic product creation and payment processing
- **Availability Management**: Real-time availability checking and conflict prevention
- **Calendar Views**: Monthly calendar display showing availability
- **User Dashboard**: View and manage personal bookings
- **Email Notifications**: Automatic confirmation emails
- **Admin Interface**: Full management of resources and reservations

### Resource Attributes
Each bookable resource can have:
- **Surface Area** (m²)
- **Location** (physical location identifier)
- **Capacity** (for meeting rooms/accommodation)
- **Minimum Duration** (days)
- **Maximum Duration** (days)
- **Pricing Tier** (Free or Professional)
- **Price per Day** (for Professional tier)

## Installation & Setup

### 1. Activate the System

The booking system is automatically loaded when you activate the Zuidakker child theme. After activation:

1. Go to **WordPress Admin** → **Bookings**
2. You'll see two menu items:
   - **Bookable Resources**: Manage your bookable items
   - **Reservations**: View and manage all bookings

### 2. Create Resource Types

Resource types are automatically created on first load:
- Boat Berth
- Small Allotment
- Meeting Room
- Accommodation

You can add more types at **Bookings** → **Resource Types**.

### 3. Add Bookable Resources

1. Go to **Bookings** → **Add New Resource**
2. Fill in the resource details:
   - **Title**: Name of the resource (e.g., "Boat Berth #1")
   - **Description**: Detailed information about the resource
   - **Featured Image**: Photo of the resource
   - **Resource Type**: Select from dropdown
   
3. Configure **Booking Details**:
   - Surface Area (m²)
   - Location
   - Capacity (if applicable)
   - Minimum Duration (default: 1 day)
   - Maximum Duration (default: 365 days)

4. Set **Pricing & Tiers**:
   - **Free Tier**: No payment required, bookings are immediately confirmed
   - **Professional Tier**: Paid bookings, integrates with WooCommerce checkout
   - Price per Day (for Professional tier only)

5. **Publish** the resource

### 4. WooCommerce Integration

For Professional tier resources:
- A WooCommerce product is **automatically created** when you save the resource
- The product is linked to the bookable resource
- When users book, they're directed to WooCommerce checkout
- Payment completion automatically confirms the reservation

## Usage

### Frontend Booking Form

Add the booking form to any page using the shortcode:

```
[booking_form]
```

**Shortcode Parameters:**

```
[booking_form resource_id="123"]
```
Display form for a specific resource only.

```
[booking_form type="boat-berth"]
```
Display form for all resources of a specific type.

### Booking Calendar

Display an availability calendar:

```
[booking_calendar]
```

**Shortcode Parameters:**

```
[booking_calendar resource_id="123"]
```
Show calendar for a specific resource.

```
[booking_calendar type="meeting-room"]
```
Show calendars for all resources of a specific type.

### User Booking Dashboard

Allow users to view their bookings:

```
[my_bookings]
```

## Booking Workflow

### Free Tier Booking
1. User logs in (or registers)
2. Selects resource and dates
3. Checks availability
4. Confirms booking
5. Reservation is immediately confirmed
6. Confirmation email sent

### Professional Tier Booking
1. User logs in (or registers)
2. Selects resource and dates
3. Checks availability
4. Confirms booking
5. Redirected to WooCommerce checkout
6. Completes payment
7. Reservation confirmed after payment
8. Confirmation email sent

## Admin Management

### Managing Resources

**Location**: WordPress Admin → Bookings → Bookable Resources

- **Add New**: Create new bookable resources
- **Edit**: Modify resource details, pricing, availability settings
- **Delete**: Remove resources (existing reservations remain)
- **Quick View**: See resource type, tier, and pricing at a glance

### Managing Reservations

**Location**: WordPress Admin → Bookings → Reservations

View all reservations with:
- Resource name
- User information
- Booking dates
- Status (Pending, Confirmed, Cancelled, Completed)
- Price

**Reservation Statuses:**
- **Pending**: Awaiting payment (Professional tier) or admin approval
- **Confirmed**: Booking confirmed and active
- **Cancelled**: Booking cancelled by user or admin
- **Completed**: Booking period has ended

### Manual Reservations

Admins can create reservations manually:

1. Go to **Bookings** → **Reservations** → **Add New**
2. Select resource and user
3. Set start and end dates
4. Choose status
5. System automatically calculates price
6. Save reservation

## Email Notifications

Confirmation emails are automatically sent when:
- Free tier booking is confirmed
- Professional tier payment is completed
- Admin manually confirms a reservation

Email includes:
- Resource name
- Booking dates
- User information
- Booking reference

## Availability System

### How It Works

The system prevents double-bookings by:
1. Checking all existing reservations for the selected resource
2. Comparing date ranges for conflicts
3. Only allowing bookings if no overlap exists

### Availability Check

Users can check availability before confirming:
- Real-time AJAX availability checking
- Visual feedback (green = available, red = unavailable)
- Displays booking summary with total price

### Calendar View

The calendar displays:
- **Green**: Available dates
- **Red**: Booked dates
- **Gray**: Past dates
- **Blue border**: Today

## Customization

### Styling

Calendar styles: `@/home/tim/projects/zuidakker/zuidakker_2.0/wp-content/themes/zuidakker-child/assets/css/booking-calendar.css`

Booking form styles are inline but can be moved to a separate CSS file.

### Email Templates

Email content can be customized in:
`@/home/tim/projects/zuidakker/zuidakker_2.0/wp-content/themes/zuidakker-child/inc/booking-reservations.php`

Look for the `zuidakker_send_reservation_confirmation()` function.

### Booking Form Fields

Modify the booking form in:
`@/home/tim/projects/zuidakker/zuidakker_2.0/wp-content/themes/zuidakker-child/inc/booking-frontend.php`

### Duration Limits

Set per-resource minimum and maximum booking durations in the resource edit screen.

## File Structure

```
wp-content/themes/zuidakker-child/
├── inc/
│   ├── booking-system.php          # Core system, CPT, resource management
│   ├── booking-reservations.php    # Reservation management, availability
│   ├── booking-frontend.php        # User-facing forms, WooCommerce integration
│   └── booking-calendar.php        # Calendar views, user dashboard
├── assets/
│   ├── js/
│   │   └── booking.js              # Frontend JavaScript for booking form
│   └── css/
│       └── booking-calendar.css    # Calendar styling
└── functions.php                    # Loads all booking modules
```

## Database Schema

### Bookable Resource Meta
- `_booking_surface_area`: Surface area in m²
- `_booking_location`: Physical location
- `_booking_capacity`: Maximum capacity
- `_booking_min_duration`: Minimum booking days
- `_booking_max_duration`: Maximum booking days
- `_booking_tier`: 'free' or 'professional'
- `_booking_price`: Price per day (Professional tier)
- `_booking_wc_product_id`: Linked WooCommerce product ID

### Reservation Meta
- `_reservation_resource_id`: Linked resource ID
- `_reservation_user_id`: User who made the booking
- `_reservation_start_date`: Start date (Y-m-d format)
- `_reservation_end_date`: End date (Y-m-d format)
- `_reservation_status`: pending|confirmed|cancelled|completed
- `_reservation_order_id`: WooCommerce order ID (if applicable)
- `_reservation_total_price`: Total booking price

## API Functions

### Check Availability
```php
zuidakker_check_availability( $resource_id, $start_date, $end_date, $exclude_reservation_id = null )
```
Returns `true` if available, `false` if booked.

### Get Resource Reservations
```php
zuidakker_get_resource_reservations( $resource_id, $status = array( 'confirmed', 'pending' ) )
```
Returns array of reservation post objects.

### Calculate Price
```php
zuidakker_calculate_reservation_price( $reservation_id )
```
Calculates and updates total price for a reservation.

### Send Confirmation
```php
zuidakker_send_reservation_confirmation( $reservation_id )
```
Sends confirmation email to the user.

## Troubleshooting

### Bookings Not Showing
- Ensure resources are published
- Check resource type assignments
- Verify user is logged in (required for bookings)

### WooCommerce Integration Issues
- Confirm WooCommerce is active
- Check that Professional tier resources have products created
- Verify WooCommerce checkout is configured

### Email Not Sending
- Check WordPress email settings
- Consider using an SMTP plugin (e.g., WP Mail SMTP)
- Verify user email addresses are valid

### Calendar Not Displaying
- Ensure CSS file is enqueued
- Check for JavaScript errors in browser console
- Verify shortcode is used correctly

## Future Enhancements

Potential additions to consider:
- **Waitlist**: Allow users to join a waitlist for booked dates
- **Recurring Bookings**: Enable weekly/monthly recurring reservations
- **Cancellation Policy**: Automated refund handling
- **Booking Reminders**: Email reminders before booking starts
- **Resource Availability Rules**: Block specific dates/periods
- **Multi-resource Bookings**: Book multiple resources at once
- **Booking Deposits**: Partial payment option
- **iCal Export**: Export bookings to calendar apps

## Support

For issues or questions:
1. Check this documentation
2. Review the code comments in each module
3. Check WordPress debug log for errors
4. Verify WooCommerce settings if payment issues occur

## Version History

**Version 1.0** (December 2025)
- Initial booking system implementation
- WooCommerce integration
- Free and Professional tiers
- Calendar views
- User dashboard
- Email notifications
