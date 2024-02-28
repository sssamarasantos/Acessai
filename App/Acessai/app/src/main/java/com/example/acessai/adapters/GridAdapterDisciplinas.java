package com.example.acessai.adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.graphics.drawable.Drawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.content.ContextCompat;

import com.example.acessai.R;
import com.example.acessai.classes.Disciplina;

import java.util.ArrayList;

public class GridAdapterDisciplinas extends ArrayAdapter<Disciplina> {
    Context _context;
    public GridAdapterDisciplinas(@NonNull Context context, ArrayList<Disciplina> disciplinaArrayList) {
        super(context, 0, disciplinaArrayList);
        _context = context;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        View view = convertView;
        if (view == null) {
            // Layout Inflater inflates each item to be displayed in GridView.
            view = LayoutInflater.from(_context).inflate(R.layout.grid_adapter_disciplinas, parent, false);
        }

        Disciplina disciplina = getItem(position);
        TextView nome = (TextView) view.findViewById(R.id.lblDisc);
        ImageView imagem = (ImageView) view.findViewById(R.id.imgViewDisc);

        if (disciplina != null) {
            @SuppressLint("DiscouragedApi") int resID = _context.getResources()
                    .getIdentifier(disciplina.getImagem(), "drawable", _context.getPackageName());

            if (resID != 0) {
                Drawable drawable = ContextCompat.getDrawable(_context, resID);
                imagem.setBackground(drawable);
            }

            nome.setText(disciplina.getNome());
        }

        return view;
    }
}
