package com.example.acessai.classes;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;

import androidx.appcompat.app.AlertDialog;

import com.example.acessai.activitys.CadastroActivity;
import com.example.acessai.activitys.HomeActivity;
import com.example.acessai.activitys.LoginActivity;
import com.koushikdutta.ion.builder.Builders;

import java.util.HashMap;

public class Session {
    SharedPreferences preferences;
    SharedPreferences.Editor editor;
    Context context;

    private static final String LOGIN = "Login";
    public static  final String KEY_EMAIL = "email";
    public static  final String KEY_SENHA = "senha";

    @SuppressLint("CommitPrefEdits")
    public Session(Context con){
        this.context = con;
        preferences = con.getSharedPreferences("loginSessao", Context.MODE_PRIVATE);
        editor = preferences.edit();
    }

    public void criarSessao(String email, String senha){
        editor.putBoolean(LOGIN, true);
        editor.putString(KEY_EMAIL, email);
        editor.putString(KEY_SENHA, senha);
        editor.commit();
    }

    public boolean checarLogin(){
        if (preferences.getBoolean(LOGIN, false)){
            return true;
        } else {
            return false;
        }
    }

    public HashMap<String, String> getUserDetails(){
        HashMap<String, String> usuario = new HashMap<>();
        usuario.put(KEY_EMAIL, preferences.getString(KEY_EMAIL, null));
        usuario.put(KEY_SENHA, preferences.getString(KEY_SENHA, null));

        return usuario;
    }

    public void logout(){
        editor.clear();
        editor.commit();
        Intent y = new Intent(context, LoginActivity.class);
        context.startActivity(y);
        ((HomeActivity) context).finish();
    }
}
