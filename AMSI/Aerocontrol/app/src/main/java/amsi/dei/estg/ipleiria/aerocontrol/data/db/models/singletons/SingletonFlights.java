package amsi.dei.estg.ipleiria.aerocontrol.data.db.models.singletons;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;
import java.util.concurrent.TimeUnit;

import amsi.dei.estg.ipleiria.aerocontrol.R;
import amsi.dei.estg.ipleiria.aerocontrol.data.db.models.Airport;
import amsi.dei.estg.ipleiria.aerocontrol.data.db.models.Flight;
import amsi.dei.estg.ipleiria.aerocontrol.data.db.models.Passenger;
import amsi.dei.estg.ipleiria.aerocontrol.data.db.models.PaymentMethod;
import amsi.dei.estg.ipleiria.aerocontrol.data.network.ApiEndPoint;
import amsi.dei.estg.ipleiria.aerocontrol.listeners.AirportsListener;
import amsi.dei.estg.ipleiria.aerocontrol.listeners.FlightsListener;
import amsi.dei.estg.ipleiria.aerocontrol.listeners.PaymentMethodsListener;
import amsi.dei.estg.ipleiria.aerocontrol.listeners.TicketBoughtListener;
import amsi.dei.estg.ipleiria.aerocontrol.utils.FlightsJsonParser;
import amsi.dei.estg.ipleiria.aerocontrol.utils.NetworkUtils;

public class SingletonFlights {

    private static SingletonFlights instance = null;

    private AirportsListener airportsListener;
    private FlightsListener flightsListener;
    private PaymentMethodsListener paymentMethodsListener;
    private TicketBoughtListener ticketBoughtListener;

    private static RequestQueue volleyQueue;

    private ArrayList<Airport> airports;
    private ArrayList<Flight> flightsGo;
    private ArrayList<Flight> flightsBack;
    private ArrayList<PaymentMethod> paymentMethods;
    private ArrayList<Passenger> ticketPassengers;

    private SingletonFlights(){
        flightsGo = new ArrayList<>();
        flightsBack = new ArrayList<>();
        paymentMethods = new ArrayList<>();
        airports = new ArrayList<>();
    }

    public static synchronized SingletonFlights getInstance(Context context){
        volleyQueue = Volley.newRequestQueue(context);
        if (instance == null) instance = new SingletonFlights();
        return instance;
    }

    /**
     * Obtém os aeroportos da API
     * @param context Contexto da atividade ou fragment
     */
    public void getAirportsAPI(Context context){
        // Dados já foram recarregados, para evitar que o utilizador dê spam
        if(airports.size() > 0) {
            airportsListener.onRefreshAirports(airports);
            return;
        }

        // Caso não haja internet
        if (!NetworkUtils.isConnectedInternet(context)){
            Toast.makeText(context, R.string.no_internet_connection, Toast.LENGTH_SHORT).show();
            return;
        }

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, ApiEndPoint.AIRPORTS, null,
                response -> {
                    airports = FlightsJsonParser.parserJsonAirports(response);
                    if (airportsListener != null && airports.size() > 0){
                        airportsListener.onRefreshAirports(airports);
                    }
                }, error -> {
            Toast.makeText(context, R.string.error_airports, Toast.LENGTH_SHORT).show();
        });

        volleyQueue.add(jsonArrayRequest);
    }

    public Airport getAirportById(int id){
        for (Airport airport: airports) {
            if (airport.getId() == id) return airport;
        }
        return null;
    }

    /**
     * Obtém os voos da API
     * @param context Contexto da atividade ou fragment
     */
    public void getFlightsAPI(Context context,boolean two_way_trip, String origin, String destiny, String numPassengers, String originDate, String comeBackDate, int tryAgain){
        // Caso não haja internet
        if (!NetworkUtils.isConnectedInternet(context)){
            Toast.makeText(context, R.string.no_internet_connection, Toast.LENGTH_SHORT).show();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ApiEndPoint.FLIGHT_SEARCH,
                response -> {
                    flightsGo = FlightsJsonParser.parserJsonFlights(response, true, context);
                    if (two_way_trip) flightsBack = FlightsJsonParser.parserJsonFlights(response, false, context);
                    else flightsBack = null;
                    if (flightsListener != null) {
                        flightsListener.onRefreshFlights(flightsGo, flightsBack);
                    } else Toast.makeText(context, "Erro", Toast.LENGTH_SHORT).show();
                }, error -> {
                    if (tryAgain == 1){
                        Toast.makeText(context, R.string.no_flights_found, Toast.LENGTH_SHORT).show();
                        return;
                    }
                    Toast.makeText(context, R.string.no_flights_found_search_more_dates, Toast.LENGTH_SHORT).show();
                    getFlightsAPI(context,two_way_trip,origin,destiny,numPassengers,originDate,comeBackDate,1);
        }){
            @Override
            public Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("origin", origin);
                params.put("destiny", destiny);
                params.put("two_way_trip", two_way_trip ? "1" : "0");
                String originDateSaveFormat = "";
                if (originDate != null) originDateSaveFormat = originDate.equals("") ? "" : convertDate(originDate);
                params.put("origin_departure_date", originDateSaveFormat == null ? "" : originDateSaveFormat);
                String comeBackDateSaveFormat = "";
                if (comeBackDate != null) comeBackDateSaveFormat= comeBackDate.equals("") ? "" : convertDate(comeBackDate);
                params.put("destiny_departure_date", comeBackDateSaveFormat == null ? "" : comeBackDateSaveFormat);
                params.put("passengers", numPassengers);
                params.put("tryAgain", String.valueOf(tryAgain));
                return params;
            }
        };

        volleyQueue.add(stringRequest);
    }

    /**
     * Converte uma data para o formato que a API recebe.
     * @param dateToConvert Data a converter
     * @return Devolve a data convertida
     */
    public String convertDate(final String dateToConvert){
        SimpleDateFormat format = new SimpleDateFormat("dd/MM/yyyy");
        String newDate = null;
        try {
            Date date = format.parse(dateToConvert);
            Calendar calendar = Calendar.getInstance();
            if (date != null) {
                calendar.setTime(date);
            }
            // +1 no mês um porque o calendar vai de 0 a 11
            newDate = String.format("%04d-%02d-%02d",calendar.get(Calendar.YEAR),(calendar.get(Calendar.MONTH)+1),calendar.get(Calendar.DAY_OF_MONTH));

        } catch (ParseException e) {
            e.printStackTrace();
        }
        return newDate;
    }

    /**
     * Envia o request da compra de um bilhete de voo para a API
     * @param context contexto da atividade ou fragmento
     * @param two_way_trip true se ida/volta, false se for só ida
     * @param flightGoId id do bilhete de ida
     * @param flightBackId id do bilhete de volta (-1 se for só de ida)
     * @param num_passengers número de passageiros dos voo
     * @param paymentMethod método de pagamento escolhido para o pagamento
     * @param token Token do utilizador
     */
    public void buyTicketAPI(Context context, boolean two_way_trip, int flightGoId, int flightBackId, int num_passengers, String paymentMethod, String token) {
        // Caso não haja internet
        if (!NetworkUtils.isConnectedInternet(context)){
            Toast.makeText(context, R.string.no_internet_connection, Toast.LENGTH_SHORT).show();
            return;
        }

        String endpoint = ApiEndPoint.TICKETS + "?access-token=" + token;

        StringRequest stringRequest = new StringRequest(Request.Method.POST, endpoint,
                response -> {
                    if (ticketBoughtListener != null) {
                        ticketBoughtListener.onTicketBought();
                    } else Toast.makeText(context, "Bilhete comprado, mas ocorreu um erro!", Toast.LENGTH_SHORT).show();

                }, error -> {
                    if (ticketBoughtListener != null) {
                        ticketBoughtListener.onErrorTicketBought();
                    } else Toast.makeText(context, R.string.error_buying_ticket, Toast.LENGTH_SHORT).show();
        }){
            @Override
            public Map<String, String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("flightGo_id", String.valueOf(flightGoId));
                params.put("flightBack_id", flightBackId == -1 ? "" : String.valueOf(flightBackId));
                params.put("payment_method", paymentMethod);
                params.put("numPassengers", String.valueOf(num_passengers));
                for (int i = 0; i < num_passengers; i++){
                    Passenger passenger = ticketPassengers.get(0);
                    params.put("name[" + i + "]", passenger.getName());
                    params.put("gender[" + i + "]", passenger.getGender());
                    params.put("extra_baggage[" + i + "]", passenger.haveExtraBaggage() ? "1" : "0");
                }
                return params;
            }
        };

        stringRequest.setRetryPolicy(new DefaultRetryPolicy(
                (int) TimeUnit.SECONDS.toMillis(20),
                0,
                DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));

        volleyQueue.add(stringRequest);
    }

    /**
     *
     * @return Devolve a lista de todos os voos de Ida.
     */
    public ArrayList<Flight> getFlightsGo() {
        return flightsGo;
    }

    /**
     *
     * @return Devolve a lista de todos os voos de Volta.
     */
    public ArrayList<Flight> getFlightsBack() {
        return flightsBack;
    }

    public void setTicketPassengers(ArrayList<Passenger> passengers) {
        this.ticketPassengers = passengers;
    }

    /**
     * Obtém os métodos de pagamento e o seu status(Ativo ou Inativo) da API
     * @param context Contexto da atividade ou fragment
     */
    public void getPaymentMethodsAPI(Context context){
        // Caso não haja internet
        if (!NetworkUtils.isConnectedInternet(context)){
            Toast.makeText(context, R.string.no_internet_connection, Toast.LENGTH_SHORT).show();
            return;
        }

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, ApiEndPoint.PAYMENT_METHODS, null,
                response -> {
                    paymentMethods = FlightsJsonParser.parserPaymentMethods(response);
                    if (paymentMethodsListener != null && paymentMethods.size()>0){
                        paymentMethodsListener.onPaymentMethodsRefresh(paymentMethods);
                    } else Toast.makeText(context, R.string.error_payment_methods, Toast.LENGTH_SHORT).show();
                }, error -> {
            Toast.makeText(context, R.string.error_payment_methods, Toast.LENGTH_SHORT).show();
        });

        volleyQueue.add(jsonArrayRequest);
    }

    /**
     *
     * @return Devolve a lista de todos os métodos de pagamento.
     */
    public ArrayList<PaymentMethod> getPaymentMethods() {
        return paymentMethods;
    }

    /**
     *
     * @param id Id do método de pagamento.
     * @return Devolve o método de pagamento.
     */
    public PaymentMethod getPaymentMethodById(int id){
        for(PaymentMethod paymentMethod : paymentMethods) {
            if(paymentMethod.getId() == id) {
                return paymentMethod;
            }
        }
        return null;
    }

    /**
     *
     * @param paymentMethod Método de pagamento a adicionar.
     */
    public void addPaymentMethod(PaymentMethod paymentMethod) {
        this.paymentMethods.add(paymentMethod);
    }

    public void setAirportsListener(AirportsListener airportsListener){
        this.airportsListener = airportsListener;
    }

    public void setFlightsListener(FlightsListener flightsListener){
        this.flightsListener = flightsListener;
    }

    public void setPaymentMethodsListener(PaymentMethodsListener paymentMethodsListener){
        this.paymentMethodsListener = paymentMethodsListener;
    }

    public void setTicketBoughtListener(TicketBoughtListener ticketBoughtListener){
        this.ticketBoughtListener = ticketBoughtListener;
    }
}
