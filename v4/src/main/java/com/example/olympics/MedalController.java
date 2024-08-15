package com.example.olympics;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

@Controller
public class MedalController {

    @Autowired
    private MedalRepository medalRepository;

    @GetMapping("/")
    public String index(Model model) {
        model.addAttribute("medals", medalRepository.findAll());
        return "index";
    }

    @PostMapping("/add")
    public String addMedal(@RequestParam String country, 
                           @RequestParam int gold, 
                           @RequestParam int silver, 
                           @RequestParam int bronze, 
                           Model model) {
        Medal medal = new Medal();
        medal.setCountry(country);
        medal.setGold(gold);
        medal.setSilver(silver);
        medal.setBronze(bronze);
        medalRepository.save(medal);
        model.addAttribute("medals", medalRepository.findAll());
        return "index";
    }
}
