package amsi.dei.estg.ipleiria.aerocontrol.data.db.models;

import java.util.ArrayList;

public class Restaurant {

    private int id;
    private String name;
    private String description;
    private String phone;
    private String logo;
    private String website;
    private String openTime;
    private String closeTime;

    private ArrayList<RestaurantItem> menu;

    public Restaurant(int id, String name, String description, String phone, String logo, String website, String openTime, String closeTime){
        this.setId(id);
        this.setName(name);
        this.setDescription(description);
        this.setPhone(phone);
        this.setLogo(logo);
        this.setWebsite(website);
        this.setOpenTime(openTime);
        this.setCloseTime(closeTime);
        menu = new ArrayList<>();
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getLogo() {
        return logo;
    }

    public void setLogo(String logo) {
        this.logo = logo;
    }

    public String getWebsite() {
        return website;
    }

    public void setWebsite(String website) {
        this.website = website;
    }

    public String getOpenTime() {
        return openTime;
    }

    public void setOpenTime(String openTime) {
        this.openTime = openTime;
    }

    public String getCloseTime() {
        return closeTime;
    }

    public void setCloseTime(String closeTime) {
        this.closeTime = closeTime;
    }

    public ArrayList<RestaurantItem> getMenu() {
        return menu;
    }

    public void setMenu(ArrayList<RestaurantItem> menu) {
        this.menu = menu;
    }

    public void addMenuItem(RestaurantItem item) {
        this.menu.add(item);
    }
}
