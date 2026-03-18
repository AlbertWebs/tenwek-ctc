# CTC Website — Public Site & Admin

Guide to the **public website** (visitor-facing pages) and a short reference for the admin panel.

---

## Public Website

### Sitemap overview (current state)

- **Home** — Hero with video, tagline, CTAs (Book Appointment, Refer a Patient), stats, and previews of services, team, and news.
- **About** — Single page: overview of the centre, history, mission & vision, and partnerships (content from config/CMS).
- **Team** — Our Team: grid of team members (name, title, photo, bio). Admin-managed.
- **Our Services** — Single page with sections: Cardiac Surgery, Thoracic Surgery, Diagnostics. Each section lists services (name, description) with optional anchor links. Admin-managed.
- **Patient Information** — Single page: how to become a patient, what to bring, referral info, etc. Admin-managed.
- **Training** — Single page: training programs (e.g. fellowship, observerships). Admin-managed.
- **Research** — Single page: research overview and publications. Admin-managed.
- **Impact** — Single page: impact stories and reach. Admin-managed.
- **Support** — Support the CTC: Donate (M-Pesa, card), Sponsor a Surgery, Equipment Needs, Partner With Us (each with enquiry form). Admin-managed donations.
- **News & Events** — Paginated list of news articles. Admin-managed (CMS-driven).
- **Contact** — Contact form plus address, phone, email, and map.

**Footer quick links:** Patient Information, News & Events, Contact. The main navbar is a flat list (no dropdowns or mega menus). Book Appointment and Refer a Patient from the hero link to Contact and Patient Information respectively.

---

### Sitemap (URL reference)

| URL | Page name | What visitors see |
|-----|-----------|--------------------|
| **`/`** | Home | Full-height hero with background video, tagline, and primary CTAs (e.g. Book Appointment, Refer a Patient). Stats strip (surgeries, countries, experience, surgeons). Preview of services (with “View all”), team (with “Meet the team”), impact text, Support CTA, and latest news. |
| **`/about`** | About the Centre | Banner with page title. Overview, history, mission, and partnerships content. |
| **`/team`** | Our Team | Banner then grid of team members (name, title, photo, bio). Content is managed in admin (Team / Staff). |
| **`/services`** | Our Services | Banner then services grouped by category: Cardiac surgery, Thoracic surgery, Diagnostics. Each service has name and description. Content is managed in admin (Services). |
| **`/patient-information`** | Patient Information | Banner then content about how to become a patient, what to bring, etc. Content is managed in admin (Patient Information). |
| **`/training`** | Training | Banner then training programs (e.g. fellowship, observerships). Content is managed in admin (Training Programs). |
| **`/research`** | Research | Banner then research areas and publications. Content is managed in admin (Research / Publications). |
| **`/impact`** | Our Impact | Banner then impact stories and reach. Content is managed in admin (Impact Stories). |
| **`/support`** | Support the CTC | Banner then cards: **Donate** (M-Pesa and Card/Stripe buttons — open payment modals), **Sponsor a Surgery**, **Equipment Needs**, **Partner With Us**. Each of the last three has a “Send enquiry” button that opens an enquiry form. Bottom CTA to contact. |
| **`/news`** | News & Events | Banner then grid/paginated list of news articles and events. Content is managed in admin (News / Articles). |
| **`/contact`** | Contact Us | Banner then contact form (name, email, message) and contact details (address, phone, email). Embedded Google Map for Tenwek Cardiothoracic Centre. |

### Forms on the public site

- **Contact** (`/contact`) — Submit sends the message; it is stored and appears in admin under **Contact & Enquiries**.
- **Support enquiries** (`/support`) — “Send enquiry” on Sponsor a Surgery, Equipment Needs, or Partner With Us opens a modal form. Submissions are stored in **Contact & Enquiries** with a source (e.g. sponsor, equipment, partner).

### Design and layout

- **Home:** Hero uses a video background (configurable). Other pages use a single banner image with a gradient overlay and clear page title.
- **Top header:** Contact details and a prominent 24/7 emergency number.
- **Responsive:** Layout, nav, and components are mobile-friendly; primary palette uses the CTC blue and secondary teal.

---

## Admin Panel (short reference)

- **Login:** `/admin-dashboard/login` (admin roles only). After login, dashboard at `/admin-dashboard`.
- **Dashboard:** Overview stats (patients, surgeries, doctors, bookings, donations), quick links, and small charts (surgeries, donations, bookings by month).
- **Sidebar:** One menu item per area — Dashboard Home, About Section, Team/Staff, Services, Patient Information, Training, Research, Impact, Donations, News, Contact & Enquiries, Bookings, Specialists (same as Team), Users & Roles. What you see depends on your role (e.g. Editors don’t see Users & Roles).
- **Actions:** Each section has list + Add / Edit / Delete; Enquiries and Bookings have search and filters. Contact form and support enquiries from the public site appear under **Contact & Enquiries**.

For full admin details (roles, permissions, every menu item), see the in-app sidebar and dashboard.
