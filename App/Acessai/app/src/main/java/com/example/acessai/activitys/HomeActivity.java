package com.example.acessai.activitys;

import android.content.DialogInterface;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.FrameLayout;
import android.widget.ToggleButton;
import android.widget.VideoView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import com.example.acessai.R;
import com.example.acessai.classes.Host;
import com.example.acessai.classes.Session;
import com.example.acessai.classes.Utils;
import com.example.acessai.fragments.HomeFragment;
import com.example.acessai.fragments.UsuarioFragment;
import com.google.android.material.navigation.NavigationView;
import com.google.gson.JsonObject;
import com.koushikdutta.ion.Ion;

import java.util.HashMap;

public class HomeActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    private Toolbar toolbar;
    private DrawerLayout drawer;
    private NavigationView navigationView;
    private Session session;
    private VideoView videoLibras;
    private FrameLayout frameLibras;
    private ToggleButton libras;
    private final String HOST_APP = new Host().getUrlApp();
    public static String assistenciaAluno;

    Utils utils = new Utils();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        session = new Session(this);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        frameLibras = (FrameLayout) findViewById(R.id.frameLibras);
        libras = (ToggleButton) findViewById(R.id.tbLibras);
        videoLibras = (VideoView) findViewById(R.id.videoLibras);
        drawer = findViewById(R.id.drawer_layout);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar,
                R.string.open_drawer, R.string.close_drawer);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        libras.setVisibility(View.INVISIBLE);
        frameLibras.setVisibility(View.INVISIBLE);

        if (savedInstanceState == null) {
            getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, new HomeFragment()).commit();
            navigationView.setCheckedItem(R.id.nav_home);
        }

        session = new Session(getApplicationContext());
        HashMap<String, String> userDetails = session.getUserDetails();
        String user = userDetails.get(Session.KEY_EMAIL);
        callAssistance(user);

        libras.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (isChecked) {
                libras.setText("");
                frameLibras.setVisibility(View.VISIBLE);
                //video
                String videoPath = "android.resource://" + getApplication().getPackageName() + "/" + R.raw.video_demonstrar;
                utils.showVideo(videoLibras, videoPath);
            } else {
                libras.setText("");
                frameLibras.setVisibility(View.INVISIBLE);
            }
        });
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()){
            case R.id.nav_sair:
                AlertDialog.Builder builder = new AlertDialog.Builder(HomeActivity.this);
                builder.setMessage("Tem certeza que deseja sair?");
                builder.setTitle("Aviso");
                builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        session.logout();
                    }
                });
                builder.setNegativeButton("Cancelar", null);
                builder.create().show();
                break;
            case R.id.nav_user:
                getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, new UsuarioFragment())
                        .addToBackStack(null).commit();
                break;
            case R.id.nav_home:
                getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, new HomeFragment())
                        .addToBackStack(null).commit();
                break;
        }
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    @Override
    public void onBackPressed() {
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else if (getSupportFragmentManager().getBackStackEntryCount() > 0){
            getSupportFragmentManager().popBackStack();
        } else {
            super.onBackPressed();
        }
    }

    public void callAssistance(String user) {
        String url = HOST_APP + "/usuario.php";
        Ion.with(getBaseContext())
                .load(url)
                .setBodyParameter("usuario", user)
                .asJsonArray()
                .setCallback((e, result) -> {
                    for (int i = 0; i < result.size(); i++){
                        JsonObject ret = result.get(i).getAsJsonObject();
                        assistenciaAluno = ret.get("ASSISTENCIA_ALUNO").getAsString();
                    }
                    utils.showLibras(frameLibras, libras, assistenciaAluno);
                });
    }
}
